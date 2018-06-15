<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotPasswordRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotPasswordControllerContract;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller implements ForgotPasswordControllerContract
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Отправляем пользователю ссылку для сброса пароля.
     *
     * @param ForgotPasswordRequestContract $request
     *
     * @return ResetLinkResponseContract
     */
    public function sendResetLinkEmailCustom(ForgotPasswordRequestContract $request) : ResetLinkResponseContract
    {
        $result = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return app()->makeWith('InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract', [
            'result' => $result,
        ]);
    }
}
