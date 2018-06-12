<?php

namespace InetStudio\ACL\Users\Services\Front;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;

/**
 * Class UsersService.
 */
class UsersService implements UsersServiceContract
{
    /**
     * @var UsersRepositoryContract
     */
    private $repository;

    /**
     * @var UserModelContract
     */
    private $user;

    /**
     * UsersService constructor.
     *
     * @param UsersRepositoryContract $repository
     */
    public function __construct(UsersRepositoryContract $repository)
    {
        $this->repository = $repository;

        $this->user = Auth::user();
    }

    /**
     * Проверяем принадлежность пользователя к администрации.
     *
     * @return string
     */
    public function isAdmin(): string
    {
        $user = $this->user;

        return ($user && $user->hasRole('admin')) ? 'admin' : 'user';
    }

    /**
     * Возвращаем пользователя.
     *
     * @return UserModelContract|null
     */
    public function getUser(): ?UserModelContract
    {
        $user = $this->user;

        return ($user) ? $user : null;
    }

    /**
     * Возвращаем id пользователя.
     *
     * @param string $email
     *
     * @return int
     */
    public function getUserId(string $email = ''): int
    {
        $user = $this->user;

        if ($email) {
            $user = $this->repository->searchItemsByField('email', $email);
        }

        return ($user) ? $user->id : 0;
    }

    /**
     * Возвращаем имя пользователя.
     *
     * @param null $request
     *
     * @return string
     */
    public function getUserName($request = null): string
    {
        $user = $this->user;

        return ($request && $request->has('name')) ? strip_tags($request->get('name')) : (($user) ? $user->name : '');
    }

    /**
     * Возвращаем email пользователя.
     *
     * @param null $request
     *
     * @return string
     */
    public function getUserEmail($request = null): string
    {
        $user = $this->user;

        return ($request && $request->has('email')) ? strip_tags($request->get('email')) : (($user) ? $user->email : '');
    }

    /**
     * Регистрируем пользователя.
     *
     * @param RegisterRequestContract $request
     *
     * @return UserModelContract
     */
    public function register(RegisterRequestContract $request): UserModelContract
    {
        $requestData = $request->only($this->repository->getModel()->getFillable());
        $activated = ['activated' => (int) config('acl.activations.enabled')];

        $item = $this->repository->save(array_merge($requestData, $activated), 0);

        return $item;
    }

    /**
     * Производим выход пользователя.
     */
    public function logout(): void
    {
        Auth::guard()->logout();
        request()->session()->invalidate();
    }

    /**
     * Редирект на авторизацию в социальной сети.
     *
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function socialRedirect(string $provider): RedirectResponse
    {
        $driver = Socialite::driver($provider);

        if ($provider !== 'twitter' && $provider !== 'instagram') {
            $driver->stateless()->scopes(['email']);
        }

        return $driver->redirect();
    }

    /**
     * Обрабатываем ответ от социальной сети.
     *
     * @param string $provider
     *
     * @return UserModelContract|null
     */
    public function socialCallback(string $provider): ?UserModelContract
    {
        $driverObj = Socialite::driver($provider);

        if ($provider !== 'twitter' && $provider !== 'instagram') {
            $driverObj->stateless();
        }

        try {
            $socialUser = $driverObj->user();
        } catch (\Exception $e) {
            return null;
        }

        $user = $this->createOrGetSocialUser($socialUser, $provider);

        if (! $user) {
            Session::flash('social_user', $socialUser);
            Session::flash('provider', $provider);
        }

        if (! $user->activated) {
            event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract', [
                'user' => $user,
            ]));
        }

        Auth::login($user, true);

        return $user;
    }

    /**
     * Создаем или получаем пользователя социальной сети.
     *
     * @param $socialUser
     * @param string $providerName
     * @param string $approveEmail
     *
     * @return mixed
     */
    public function createOrGetSocialUser($socialUser, string $providerName, string $approveEmail = '')
    {
        $email = ($approveEmail) ? $approveEmail : $socialUser->getEmail();

        $socialProfile = UserSocialProfileModel::where('provider', $providerName)->where('provider_id', $socialUser->getId())->first();

        if (! $email && ! $socialProfile) {
            return;
        }

        if (! $socialProfile) {
            $socialProfile = UserSocialProfileModel::create([
                'provider' => $providerName,
                'provider_id' => $socialUser->getId(),
                'provider_email' => $email,
            ]);
        }

        $user = $socialProfile->user;

        if (! $user) {
            $user = User::where('email', $email)->first();
        }

        if (! $user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialProfile->provider_email,
                'password' => Hash::make($socialUser->getName().config('app.key').$socialUser->getEmail()),
                'activated' => ($approveEmail) ? 0 : 1,
            ]);

            if ($approveEmail) {
                event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract', [
                    'user' => $user,
                ]));
            }

            event(app()->makeWith('InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract', [
                'object' => $user,
            ]));
        } else {
            if (! $user->hasRole('social_user')) {
                $user->update([
                    'activated' => 1,
                ]);

                event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract', [
                    'user' => $user,
                ]));
            }
        }

        $socialProfile->user()->associate($user);
        $socialProfile->save();

        return $user;
    }
}
