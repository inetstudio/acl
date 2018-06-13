<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use App\Http\Controllers\Auth\LoginController as BaseLoginController;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\LogoutResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract;

/**
 * Class LoginController.
 */
class LoginController extends BaseLoginController implements LoginControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SocialLoginController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');
    }

    /**
     * Авторизация пользователя.
     *
     * @param LoginRequestContract $request
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     *
     * @throws ValidationException
     */
    public function loginCustom(LoginRequestContract $request)
    {
        $baseRequest = request();

        if ($this->hasTooManyLoginAttempts($baseRequest)) {
            $this->fireLockoutEvent($baseRequest);

            return $this->sendLockoutResponse($baseRequest);
        }

        if ($user = $this->checkActivation($baseRequest)) {
            return $this->sendNeedActivationResponse($user);
        }

        if ($this->attemptLogin($baseRequest)) {
            return $this->sendLoginResponseJSON($baseRequest);
        }

        $this->incrementLoginAttempts($baseRequest);

        return $this->sendFailedLoginResponse($baseRequest);
    }

    /**
     * Ответ при удачной авторизации.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponseJSON(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Проверяем активацию пользователя.
     *
     * @param Request $request
     *
     * @return null
     */
    public function checkActivation(Request $request)
    {
        $provider = \Auth::getProvider();

        $credentials = $this->credentials($request);
        $user = $provider->retrieveByCredentials($credentials);

        if (! is_null($user) && $provider->validateCredentials($user, $credentials)) {
            if (! $user->activated) {
                return $user;
            }
        }
    }

    /**
     * Ошибка активации аккаунта.
     *
     * @param UserModelContract $user
     */
    public function sendNeedActivationResponse(UserModelContract $user)
    {
        event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract', [
            'user' => $user
        ]));

        throw ValidationException::withMessages([
            'email' => [
                trans('admin.module.acl.activations::activation.activationWarning'),
            ],
        ]);
    }

    /**
     * Выход пользователя.
     *
     * @param Request $request
     *
     * @return LogoutResponseContract
     */
    public function logout(Request $request): LogoutResponseContract
    {
        $this->services['users']->logout();

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Front\LogoutResponseContract', [
            'result' => [
                'success' => true,
            ],
        ]);
    }
}
