<?php

namespace InetStudio\ACL\Users\Http\Controllers\Front;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Login\LogoutResponseContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

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
     * LoginController constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->middleware('guest')->except('logout');
    }

    /**
     * Авторизация пользователя.
     *
     * @param  LoginRequestContract  $request
     *
     * @return Response|void
     *
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function login(LoginRequestContract $request)
    {
        $baseRequest = request();

        if ($this->hasTooManyLoginAttempts($baseRequest)) {
            $this->fireLockoutEvent($baseRequest);

            $this->sendLockoutResponse($baseRequest);
        }

        if ($user = $this->checkActivation($baseRequest)) {
            return $this->sendNeedActivationResponse($user);
        }

        if ($this->attemptLogin($baseRequest)) {
            Session::put('login_type', 'regular');
            return $this->sendLoginResponseJSON($baseRequest);
        }

        $this->incrementLoginAttempts($baseRequest);

        return $this->sendFailedLoginResponse($baseRequest);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  Request  $request
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => [Lang::get('admin.module.acl.users::auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Ответ при удачной авторизации.
     *
     * @param  Request  $request
     *
     * @return Response
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
     * @param  Request  $request
     *
     * @throws ValidationException
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
     * @param  Request  $request
     *
     * @return UserModelContract|null
     */
    public function checkActivation(Request $request): ?UserModelContract
    {
        $provider = Auth::getProvider();

        $credentials = $this->credentials($request);
        $user = $provider->retrieveByCredentials($credentials);

        if (! is_null($user) && $provider->validateCredentials($user, $credentials)) {
            if (! $user->activated) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Ошибка активации аккаунта.
     *
     * @param  UserModelContract  $user
     *
     * @throws ValidationException
     *
     * @throws BindingResolutionException
     */
    public function sendNeedActivationResponse(UserModelContract $user)
    {
        event(
            app()->make(
                'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract',
                compact('user')
            )
        );

        throw ValidationException::withMessages([
            'email' => [
                trans('admin.module.acl.activations::activation.activationWarning'),
            ],
        ]);
    }

    /**
     * Выход пользователя.
     *
     * @param  Request  $request
     * @param  LogoutResponseContract  $response
     *
     * @return LogoutResponseContract
     */
    public function logout(Request $request, LogoutResponseContract $response): LogoutResponseContract
    {
        Session::forget('login_type');
        
        return $response;
    }
}
