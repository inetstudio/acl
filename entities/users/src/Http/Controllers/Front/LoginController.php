<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\LogoutResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract;

/**
 * Class LoginController.
 */
class LoginController extends Controller implements LoginControllerContract
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
     * SocialLoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

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
    public function login(LoginRequestContract $request)
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
     * Redirect the user after determining they are locked out.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => [Lang::get('admin.module.acl.users::auth.throttle', ['seconds' => $seconds])],
        ])->status(423);
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
     * Ответ при неудачной авторизации.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('admin.module.acl.users::auth.failed')],
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
