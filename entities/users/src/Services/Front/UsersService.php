<?php

namespace InetStudio\ACL\Users\Services\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;

/**
 * Class UsersService.
 */
class UsersService implements UsersServiceContract
{
    /**
     * @var array
     */
    private $repositories;

    /**
     * @var UserModelContract
     */
    private $user;

    /**
     * UsersService constructor.
     */
    public function __construct()
    {
        $this->repositories['users'] = app()->make('InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract');
        $this->repositories['usersSocialProfiles'] = app()->make('InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract');

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
        return $this->user;
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
            $user = $this->repositories['users']->searchItems([['email', '=', $email]])->first();
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

        return ($request && $request->has('email')) ? strip_tags(strtolower($request->get('email'))) : (($user) ? $user->email : '');
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
        $requestData = $request->only($this->repositories['users']->getModel()->getFillable());
        $activated = ['activated' => (int) (! config('acl.activations.enabled'))];

        $item = $this->repositories['users']->save(array_merge($requestData, $activated), 0);

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

        if (! $user->id) {
            Session::flash('social_user', $socialUser);
            Session::flash('provider', $provider);
        } else {
            if (! $user->activated) {
                event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract', [
                    'user' => $user,
                ]));
            } else {
                Auth::login($user, true);
            }
        }

        return $user;
    }

    /**
     * Создаем или получаем пользователя социальной сети.
     *
     * @param $socialUser
     * @param string $providerName
     * @param string $approveEmail
     *
     * @return UserModelContract|null
     */
    public function createOrGetSocialUser($socialUser, string $providerName, string $approveEmail = ''): ?UserModelContract
    {
        $email = ($approveEmail) ? $approveEmail : $socialUser->getEmail();

        $socialProfile = $this->repositories['usersSocialProfiles']->searchItems([
            ['provider', '=', $providerName],
            ['provider_id', '=', $socialUser->getId()],
        ])->first();

        if (! $email && ! $socialProfile) {
            return $this->repositories['users']->getItemByID(0);
        }

        if (! $socialProfile) {
            $socialProfile = $this->repositories['usersSocialProfiles']->save([
                'provider' => $providerName,
                'provider_id' => $socialUser->getId(),
                'provider_email' => $email,
            ], 0);
        }

        $user = $socialProfile->user;

        if (! $user) {
            $user = $this->repositories['users']->searchItems([['email', '=', $email]])->first();
        }

        if (! $user) {
            $user = $this->repositories['users']->save([
                'name' => $socialUser->getName(),
                'email' => $socialProfile->provider_email,
                'password' => $socialUser->getName().config('app.key').$socialUser->getEmail(),
                'activated' => ($approveEmail) ? 0 : 1,
            ], 0);

            if ($approveEmail) {
                event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract', [
                    'user' => $user,
                ]));
            }

            event(app()->makeWith('InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract', [
                'user' => $user,
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

    /**
     * Сохраняем модель.
     *
     * @param array $data
     * @param int $id
     *
     * @return UserModelContract
     */
    public function save(array $data, int $id): UserModelContract
    {
        $item = $this->repositories['users']->save($data, $id);

        return $item;
    }
}
