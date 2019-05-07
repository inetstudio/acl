<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract;

/**
 * Class SocialRegisterApproveEmailResponse.
 */
class SocialRegisterApproveEmailResponse implements SocialRegisterApproveEmailResponseContract, Responsable
{
    /**
     * Результат подтверждения почтового ящика.
     *
     * @var array
     */
    private $result;

    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SocialRegisterApproveEmailResponse constructor.
     *
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;

        $this->services['SEO'] = app()->make('InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract');
    }

    /**
     * Возвращаем ответ при подтверждении почтового ящика.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        Session::forget('social_user');
        Session::forget('provider');

        if ($request->ajax()) {
            return response()->json($this->result, 200);
        } else {
            return view('admin.module.acl.users::front.email_approve', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'activation' => $this->result,
            ]);
        }
    }
}
