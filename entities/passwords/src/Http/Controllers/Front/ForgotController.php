<?php

namespace InetStudio\ACL\Passwords\Http\Controllers\Front;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotControllerContract;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotRequestContract;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

class ForgotController extends Controller implements ForgotControllerContract
{
    use SendsPasswordResetEmails;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->middleware('guest');
    }

    public function sendResetLinkEmail(
        ForgotRequestContract $request,
        ResetLinkResponseContract $response
    ): ResetLinkResponseContract {
        $response->setBroker($this->broker());

        return $response;
    }
}
