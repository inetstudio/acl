<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Login\LoginResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class LoginController.
 */
class LoginController extends Controller implements LoginControllerContract
{
    use AuthenticatesUsers;

    /**
     * Куда редиректим пользователя после авторизации.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * LoginController constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->redirectTo = route('back');

        $this->middleware(
            'back.guest',
            [
                'except' => 'logout',
            ]
        );
    }

    /**
     * Отображаем страницу авторизации.
     *
     * @param  Request  $request
     * @param  LoginResponseContract  $response
     *
     * @return LoginResponseContract
     */
    public function showLoginForm(Request $request, LoginResponseContract $response): LoginResponseContract
    {
        return $response;
    }

    /**
     * Возвращаем поле, по которому происходит авторизация.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        request()->merge([$field => $login]);

        return $field;
    }
}
