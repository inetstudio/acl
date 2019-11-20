<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\RegistersUsers;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Register\RegisterResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller implements RegisterControllerContract
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * RegisterController constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->middleware('guest');
    }

    /**
     * Регистрация пользователя.
     *
     * @param  RegisterRequestContract  $request
     * @param  RegisterResponseContract  $response
     *
     * @return RegisterResponseContract
     */
    public function register(RegisterRequestContract $request, RegisterResponseContract $response): RegisterResponseContract
    {
        return $response;
    }
}
