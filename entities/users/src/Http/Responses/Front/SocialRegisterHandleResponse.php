<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterHandleResponseContract;

/**
 * Class SocialRegisterHandleResponse.
 */
class SocialRegisterHandleResponse implements SocialRegisterHandleResponseContract, Responsable
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * @var
     */
    protected $user;

    /**
     * SocialRegisterHandleResponse constructor.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->services['SEO'] = app()->make('InetStudio\Meta\Contracts\Services\Front\MetaServiceContract');

        $this->user = $user;
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
        if (! $this->user) {
            return response()->redirectTo('/');
        } elseif (false) {
            return response()->redirectToRoute('front.oauth.email');
        } elseif (! $this->user->activated) {
            return view('admin::front.auth.activate', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'activation' => [
                    'success' => false,
                    'message' => trans('admin.module.acl.activations::activation.activationWarning'),
                ],
            ]);
        }
    }
}
