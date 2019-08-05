<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract;

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
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');
    }

    /**
     * Регистрация пользователя.
     *
     * @param RegisterRequestContract $request
     *
     * @return RegisterResponseContract
     */
    public function register(RegisterRequestContract $request): RegisterResponseContract
    {
        $user = $this->services['users']->register($request);

        event(new Registered($user));

        if (config('acl.register.login_after_register')) {
            Auth::login($user, true);
        }

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract', [
            'result' => [
                'success' => true,
                'message' => (config('acl.activations.enabled')) ? trans('admin.module.acl.activations::activation.activationStatus') : 'Пользователь успешно зарегистрирован',
            ]
        ]);
    }
}
