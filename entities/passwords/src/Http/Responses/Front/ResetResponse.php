<?php

namespace InetStudio\ACL\Passwords\Http\Responses\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetResponseContract;
use InetStudio\ACL\Passwords\Contracts\Services\Front\ItemsServiceContract as PasswordsServiceContract;

/**
 * Class ResetResponse.
 */
class ResetResponse implements ResetResponseContract
{
    /**
     * @var PasswordsServiceContract
     */
    private $passwordsService;

    /**
     * @var string
     */
    protected $broker;

    /**
     * ResetResponse constructor.
     *
     * @param  PasswordsServiceContract  $passwordsService
     */
    public function __construct(PasswordsServiceContract $passwordsService)
    {
        $this->passwordsService = $passwordsService;
    }

    /**
     * @param $broker
     */
    public function setBroker($broker): void
    {
        $this->broker = $broker;
    }

    /**
     * Возвращаем ответ при сбросе пароля.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    public function toResponse($request)
    {
        $result = $this->passwordsService->reset($request, $this->broker);

        if ($result == Password::PASSWORD_RESET) {
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
