<?php

namespace InetStudio\ACL\Users\Services\Front\Auth;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\SocialProfiles\Contracts\Services\Front\ItemsServiceContract as SocialProfilesServiceContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
     * @param array $data
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function redirect(array $data, string $provider): RedirectResponse
    {
        $driver = Socialite::driver($provider);

        if ($provider !== 'twitter' && $provider !== 'instagram') {
            $driver->stateless()->scopes(['email']);
        }

        if ($provider !== 'twitter') {
            $driver->with($data);
        }

        return $driver->redirect();
    }

    /**
     * Обрабатываем ответ от социальной сети.
     *
     * @param string $provider
     *
     * @return UserModelContract|null
     *
     * @throws BindingResolutionException
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

        if($provider == 'vkontakte') {
            $socialUser->email = $socialUser->accessTokenResponseBody['email'] ?? null;
        }

        $user = $this->createOrGetSocialUser($socialUser, $provider);

        if (! $user['id']) {
            Session::put('social_user', $socialUser);
            Session::put('provider', $provider);
            Session::flash('auth_event', 'social_reg');
        } else {
            if (! $user['activated']) {
                event(
                    app()->make(
                        'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract',
                        compact('user')
                    )
                );
            } else {
                Session::put('login_type', 'social');
                Session::put('provider', $provider);
                Session::flash('auth_event', 'social_auth');
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
     *
     * @throws BindingResolutionException
     */
    public function createOrGetSocialUser($socialUser, string $providerName, string $approveEmail = ''): ?UserModelContract
    {
        $email = ($approveEmail) ? $approveEmail : $socialUser->email ?? $socialUser->getEmail();
        $email = (! $email && config('acl_users.social_email_generate'))
            ? $providerName.'_'.$socialUser->getId().'@'.parse_url(config('app.url'), PHP_URL_HOST)
            : $email;

        $socialProfile = $this->socialProfilesService->getModel()->where([
            ['provider', '=', $providerName],
            ['provider_id', '=', $socialUser->getId()],
        ])->first();

        if (! $email && ! $socialProfile) {
            return $this->getItemById(0);
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

            if ($socialUser->avatar) {
                $user->addMediaFromUrl($socialUser->avatar)->toMediaCollection('image', 'users');
            }

            $socialProfile->user()->associate($user);
            $socialProfile->save();

            event(
                app()->make(
                    'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract',
                    compact('user')
                )
            );

            if ($approveEmail) {
                event(
                    app()->make(
                        'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract',
                        compact('user')
                    )
                );
            }
        } else {
            if (! $user->hasRole('social_user')) {
                $user->update([
                    'activated' => 1,
                ]);

                event(
                    app()->make(
                        'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract',
                        compact('user')
                    )
                );
            }
        }

        $socialProfile->user()->associate($user);
        $socialProfile->save();

        return $user;
    }
}
