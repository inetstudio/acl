<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Login;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\LoginServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Login\LogoutResponseContract;

/**
 * Class LogoutResponse.
 */
class LogoutResponse implements LogoutResponseContract
{
    /**
     * @var LoginServiceContract
     */
    protected $loginService;

    /**
     * ApproveEmailResponse constructor.
     *
     * @param  LoginServiceContract  $loginService
     */
    public function __construct(LoginServiceContract $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $this->loginService->logout();

        $result = [
            'success' => true,
        ];

        if ($request->ajax()) {
            return response()->json($result, 200);
        } else {
            return response()->redirectTo('/');
        }
    }
}
