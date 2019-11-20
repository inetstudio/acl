<?php

namespace InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetFormResponseContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetResponseContract;

/**
 * Interface ResetControllerContract.
 */
interface ResetControllerContract
{
    /**
     * Отображаем форму для сброса пароля.
     *
     * @param  Request  $request
     * @param  ResetFormResponseContract  $response
     *
     * @return ResetFormResponseContract
     */
    public function showResetForm(Request $request, ResetFormResponseContract $response): ResetFormResponseContract;

    /**
     * Сбрасываем пользовательский пароль.
     *
     * @param  ResetRequestContract  $request
     * @param  ResetResponseContract  $response
     *
     * @return ResetResponseContract
     */
    public function reset(ResetRequestContract $request, ResetResponseContract $response): ResetResponseContract;
}
