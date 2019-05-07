<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Contracts\Support\Responsable;
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
        $this->services['SEO'] = app()->make('InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract');

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
        } elseif (! $this->user->id) {
            return response()->redirectToRoute('front.acl.users.oauth.email');
        } elseif (! $this->user->activated) {
            return view('admin.module.acl.activations::front.activate', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'activation' => [
                    'success' => false,
                    'message' => trans('admin.module.acl.activations::activation.activationWarning'),
                ],
            ]);
        } else {
            return response()->redirectTo('/');
        }
    }
}
