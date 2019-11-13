<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotControllerContract;

/**
 * Class ForgotController.
 */
class ForgotController extends Controller implements ForgotControllerContract
{
    use SendsPasswordResetEmails;

    /**
     * ForgotPasswordController constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->middleware('guest');
    }

    /**
     * Отправляем пользователю ссылку для сброса пароля.
     *
     * @param  ForgotRequestContract  $request
     * @param  ResetLinkResponseContract  $response
     *
     * @return ResetLinkResponseContract
     */
    public function sendResetLinkEmail(
        ForgotRequestContract $request,
        ResetLinkResponseContract $response
    ): ResetLinkResponseContract {
        $response->setBroker($this->broker());

        return $response;
    }
}
