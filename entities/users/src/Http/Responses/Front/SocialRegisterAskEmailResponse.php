<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract;

/**
 * Class SocialRegisterAskEmailResponse.
 */
class SocialRegisterAskEmailResponse implements SocialRegisterAskEmailResponseContract, Responsable
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SocialRegisterAskEmailResponse constructor.
     *
     */
    public function __construct()
    {
        $this->services['SEO'] = app()->make('InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract');
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
        if (! Session::has('social_user')) {
            return response()->redirectTo('/');
        } else {
            return view('admin.module.acl.users::front.pages.email')->with([
                'SEO' => $this->services['SEO']->getAllTags(null),
            ]);
        }
    }
}
