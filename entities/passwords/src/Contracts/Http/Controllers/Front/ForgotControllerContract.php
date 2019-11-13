<?php

namespace InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front;

use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;

/**
 * Interface ForgotControllerContract.
 */
interface ForgotControllerContract
{
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
    ): ResetLinkResponseContract;
}
