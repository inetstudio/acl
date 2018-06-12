<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ResetPasswordController as BaseResetPasswordController;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetPasswordRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordResponseContract;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ResetPasswordControllerContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordFormResponseContract;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends BaseResetPasswordController implements ResetPasswordControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * ResetPasswordController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->services['passwords'] = app()->make('InetStudio\ACL\Passwords\Contracts\Services\Front\PasswordsServiceContract');
    }

    /**
     * Отображаем форму для сброса пароля.
     *
     * @param Request $request
     * @param null $token
     *
     * @return ResetPasswordFormResponseContract
     */
    public function showResetForm(Request $request, $token = null): ResetPasswordFormResponseContract
    {
        return app()->makeWith('InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordFormResponseContract', [
            'token' => $token
        ]);
    }

    /**
     * Сбрасываем пользовательский пароль.
     *
     * @param ResetPasswordRequestContract $request
     *
     * @return ResetPasswordResponseContract
     */
    public function resetCustom(ResetPasswordRequestContract $request): ResetPasswordResponseContract
    {
        $result = $this->services['passwords']->reset($request, $this->broker());

        return app()->makeWith('InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordResponseContract', [
            'result' => $result,
        ]);
    }
}
