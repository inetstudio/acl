<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\LogoutResponseContract;

/**
 * Class LogoutResponse.
 */
class LogoutResponse implements LogoutResponseContract, Responsable
{
    /**
     * Результат регистрации.
     *
     * @var array
     */
    private $result;

    /**
     * RegisterResponse constructor.
     *
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        if ($request->ajax()) {
            return response()->json($this->result, 200);
        } else {
            return response()->redirectTo('/');
        }
    }
}
