<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterHandleResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract;

/**
 * Class SocialLoginController.
 */
class SocialLoginController extends Controller implements SocialLoginControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SocialLoginController constructor.
     */
    public function __construct()
    {
        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');
    }

    /**
     * Редирект на авторизацию в социальной сети.
     *
     * @param string $provider
     *
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        $response = $this->services['users']->socialRedirect($provider);

        return $response;
    }

    /**
     * Обрабатываем ответ от социальной сети.
     *
     * @param string $provider
     *
     * @return SocialRegisterHandleResponseContract
     */
    public function handleProviderCallback(string $provider): SocialRegisterHandleResponseContract
    {
        $user = $this->services['users']->socialCallback($provider);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterHandleResponseContract', [
            'user' => $user,
        ]);
    }

    /**
     * Если не получили почтовый ящик при регистрации, то спрашиваем пользователя.
     *
     * @return SocialRegisterAskEmailResponseContract
     */
    public function askEmail(): SocialRegisterAskEmailResponseContract
    {
        return app()->make('InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract');
    }

    /**
     * Пользователь ввел почтовый ящик для подтверждения.
     *
     * @param EmailRequestContract $request
     *
     * @return SocialRegisterApproveEmailResponseContract
     */
    public function approveEmail(EmailRequestContract $request): SocialRegisterApproveEmailResponseContract
    {
        $socialUser = Session::get('social_user');
        $provider = Session::get('provider');
        $email = $request->get('email');

        $this->services['users']->createOrGetSocialUser($socialUser, $provider, $email);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract', [
            'result' => [
                'success' => true,
                'message' => trans('admin.module.acl.activations::activation.activationStatus'),
            ],
        ]);
    }
}
