<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract;

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
    protected $redirectTo = '';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = route('back');

        $this->middleware('back.guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Отображаем страницу авторизации.
     *
     * @return LoginResponseContract
     */
    public function showLoginForm(): LoginResponseContract
    {
        return app()->make('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract');
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
