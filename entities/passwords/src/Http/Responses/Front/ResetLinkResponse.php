<?php

namespace InetStudio\ACL\Passwords\Http\Responses\Front;

use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract;

/**
 * Class ResetLinkResponse.
 */
class ResetLinkResponse implements ResetLinkResponseContract, Responsable
{
    /**
     * @var string
     */
    private $result;

    /**
     * ResetLinkResponse constructor.
     *
     * @param string $result
     */
    public function __construct(string $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при получении ссылки для сброса пароля.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        if ($this->result == Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => trans('admin.module.acl.passwords::'.$this->result),
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => [
                    trans('admin.module.acl.passwords::'.$this->result),
                ],
            ]);
        }
    }
}
