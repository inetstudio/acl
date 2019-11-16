<?php

namespace InetStudio\ACL\Passwords\Http\Responses\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;

/**
 * Class ResetLinkResponse.
 */
class ResetLinkResponse implements ResetLinkResponseContract
{
    /**
     * @var string
     */
    protected $broker;

    /**
     * @param $broker
     */
    public function setBroker($broker): void
    {
        $this->broker = $broker;
    }

    /**
     * Возвращаем ответ при получении ссылки для сброса пароля.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    public function toResponse($request)
    {
        $result = $this->broker->sendResetLink(
            $request->only('email')
        );

        if ($result == Password::RESET_LINK_SENT) {
            return response()->json(
                [
                    'success' => true,
                    'message' => trans('admin.module.acl.passwords::'.$result),
                ]
            );
        } else {
            throw ValidationException::withMessages(
                [
                    'email' => [
                        trans('admin.module.acl.passwords::'.$result),
                    ],
                ]
            );
        }
    }
}
