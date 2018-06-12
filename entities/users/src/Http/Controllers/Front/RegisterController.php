<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth\RegisterController as BaseRegisterController;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract;

/**
 * Class RegisterController.
 */
class RegisterController extends BaseRegisterController implements RegisterControllerContract
{
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
        parent::__construct();

        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');
    }

    /**
     * Регистрация пользователя.
     *
     * @param RegisterRequestContract $request
     *
     * @return RegisterResponseContract
     */
    public function registerCustom(RegisterRequestContract $request): RegisterResponseContract
    {
        $user = $this->services['users']->register($request);

        event(new Registered($user));

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract', [
            'result' => [
                'success' => true,
                'message' => trans('admin::activation.activationStatus'),
            ]
        ]);
    }
}
