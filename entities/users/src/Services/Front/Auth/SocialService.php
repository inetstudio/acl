<?php

namespace InetStudio\ACL\Users\Services\Front\Auth;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;
use InetStudio\ACL\SocialProfiles\Contracts\Services\Front\ItemsServiceContract as SocialProfilesServiceContract;

/**
 * Class SocialService.
 */
class SocialService extends BaseService implements SocialServiceContract
{
    /**
     * @var SocialProfilesServiceContract
     */
    protected $socialProfilesService;

    /**
     * ItemsService constructor.
     *
     * @param  UserModelContract  $model
     * @param  SocialProfilesServiceContract  $socialProfilesService
     */
    public function __construct(UserModelContract $model, SocialProfilesServiceContract $socialProfilesService)
    {
        parent::__construct($model);

        $this->socialProfilesService = $socialProfilesService;
    }

    /**
     * Редирект на авторизацию в социальной сети.
     *
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function redirect(string $provider): RedirectResponse
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
    public function callback(string $provider): ?UserModelContract
    {
        $driverObj = Socialite::driver($provider);

        if ($provider !== 'twitter' && $provider !== 'instagram') {
            $driverObj->stateless();
        }

        try {
            $socialUser = $driverObj->user();
        } catch (Exception $e) {
            return null;
        }

        $user = $this->createOrGetSocialUser($socialUser, $provider);

        if (! $user['id']) {
            Session::put('social_user', $socialUser);
            Session::put('provider', $provider);
        } else {
            if (! $user['activated']) {
                event(
                    app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract',
                        [
                            'user' => $user,
                        ]
                    )
                );
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

        $socialProfile = $this->socialProfilesService->getModel()->where([
            ['provider', '=', $providerName],
            ['provider_id', '=', $socialUser->getId()],
        ])->first();

        if (! $email && ! $socialProfile) {
            return $this->getItemByID(0);
        }

        if (! $socialProfile) {
            $socialProfile = $this->socialProfilesService->saveModel([
                'provider' => $providerName,
                'provider_id' => $socialUser->getId(),
                'provider_email' => $email,
            ], 0);
        }

        $user = $socialProfile->user;

        if (! $user) {
            $user = $this->model->where([['email', '=', $email]])->first();
        }

        if (! $user) {
            $user = $this->saveModel([
                'name' => $socialUser->getName(),
                'email' => $socialProfile->provider_email,
                'password' => $socialUser->getName().config('app.key').$socialUser->getEmail(),
                'activated' => ($approveEmail) ? 0 : 1,
            ], 0);

            $socialProfile->user()->associate($user);
            $socialProfile->save();

            event(app()->makeWith('InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract', [
                'user' => $user,
            ]));

            if ($approveEmail) {
                event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract', [
                    'user' => $user,
                ]));
            }
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
