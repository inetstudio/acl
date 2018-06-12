<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Users;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract;

/**
 * Class LoginResponse.
 */
class LoginResponse implements LoginResponseContract, Responsable
{
    /**
     * Возвращаем ответ при открытии страницы авторизации.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.acl.users::back.pages.login');
    }
}
