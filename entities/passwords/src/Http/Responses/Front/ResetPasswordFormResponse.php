<?php

namespace InetStudio\ACL\Passwords\Http\Responses\Front;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordFormResponseContract;

/**
 * Class ResetPasswordFormResponse.
 */
class ResetPasswordFormResponse implements ResetPasswordFormResponseContract, Responsable
{
    /**
     * Токен.
     *
     * @var mixed
     */
    private $token;

    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * ResetPasswordFormResponse constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;

        $this->services['SEO'] = app()->make('InetStudio\Meta\Contracts\Services\Front\MetaServiceContract');
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
            return response()->json($this->token, 200);
        } else {
            return view('admin.module.acl.passwords::front.reset', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'token' => $this->token,
            ]);
        }
    }
}
