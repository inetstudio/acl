<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Foundation\Application;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetResponseContract;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ResetControllerContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetFormResponseContract;

/**
 * Class ResetController.
 */
class ResetController extends Controller implements ResetControllerContract
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * ResetController constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->middleware('guest');
    }

    /**
     * Отображаем форму для сброса пароля.
     *
     * @param  Request  $request
     * @param  ResetFormResponseContract  $response
     *
     * @return ResetFormResponseContract
     */
    public function showResetForm(Request $request, ResetFormResponseContract $response): ResetFormResponseContract
    {
        return $response;
    }

    /**
     * Сбрасываем пользовательский пароль.
     *
     * @param  ResetRequestContract  $request
     * @param  ResetResponseContract  $response
     *
     * @return ResetResponseContract
     */
    public function reset(ResetRequestContract $request, ResetResponseContract $response): ResetResponseContract
    {
        $response->setBroker($this->broker());

        return $response;
    }
}
