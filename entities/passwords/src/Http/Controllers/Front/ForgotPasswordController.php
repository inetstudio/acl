<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;
use App\Http\Controllers\Auth\ForgotPasswordController as BaseForgotPasswordController;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotPasswordRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotPasswordControllerContract;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends BaseForgotPasswordController implements ForgotPasswordControllerContract
{
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
