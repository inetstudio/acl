<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Login;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Login\LoginResponseContract;

/**
 * Class LoginResponse.
 */
class LoginResponse implements LoginResponseContract
{
    /**
     * Возвращаем ответ при открытии страницы авторизации.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return view('admin.module.acl.users::back.pages.login');
    }
}
