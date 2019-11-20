<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\ApproveEmailResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\AskEmailResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\HandleProviderCallbackResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\RedirectToProviderResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class SocialLoginController.
 */
class SocialLoginController extends Controller implements SocialLoginControllerContract
{
    /**
     * Редирект на авторизацию в социальной сети.
     *
     * @param  Request  $request
     * @param  RedirectToProviderResponseContract  $response
     *
     * @return RedirectToProviderResponseContract
     */
    public function redirectToProvider(
        Request $request,
        RedirectToProviderResponseContract $response
    ): RedirectToProviderResponseContract {
        return $response;
    }

    /**
     * Обрабатываем ответ от социальной сети.
     *
     * @param  Request  $request
     * @param  HandleProviderCallbackResponseContract  $response
     *
     * @return HandleProviderCallbackResponseContract
     */
    public function handleProviderCallback(
        Request $request,
        HandleProviderCallbackResponseContract $response
    ): HandleProviderCallbackResponseContract {
        return $response;
    }

    /**
     * Если не получили почтовый ящик при регистрации, то спрашиваем пользователя.
     *
     * @param  Request  $request
     * @param  AskEmailResponseContract  $response
     *
     * @return AskEmailResponseContract
     */
    public function askEmail(Request $request, AskEmailResponseContract $response): AskEmailResponseContract
    {
        return $response;
    }

    /**
     * Пользователь ввел почтовый ящик для подтверждения.
     *
     * @param  EmailRequestContract  $request
     * @param  ApproveEmailResponseContract  $response
     *
     * @return ApproveEmailResponseContract
     */
    public function approveEmail(
        EmailRequestContract $request,
        ApproveEmailResponseContract $response
    ): ApproveEmailResponseContract {
        return $response;
    }
}
