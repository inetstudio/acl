<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Social;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\ApproveEmailResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract as MetaServiceContract;

/**
 * Class ApproveEmailResponse.
 */
class ApproveEmailResponse implements ApproveEmailResponseContract
{
    /**
     * @var SocialServiceContract
     */
    protected $socialService;

    /**
     * @var MetaServiceContract
     */
    protected $metaService;

    /**
     * ApproveEmailResponse constructor.
     *
     * @param  SocialServiceContract  $socialService
     * @param  MetaServiceContract  $metaService
     */
    public function __construct(SocialServiceContract $socialService, MetaServiceContract $metaService)
    {
        $this->socialService = $socialService;
        $this->metaService = $metaService;
    }

    /**
     * Возвращаем ответ при подтверждении почтового ящика.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $socialUser = Session::get('social_user');
        $provider = Session::get('provider');
        $email = $request->get('email');

        $this->socialService->createOrGetSocialUser($socialUser, $provider, $email);

        Session::forget('social_user');
        Session::forget('provider');

        $result = [
            'success' => true,
            'message' => trans('admin.module.acl.activations::activation.activationStatus'),
        ];

        if ($request->ajax()) {
            return response()->json($result, 200);
        } else {
            return view('admin.module.acl.users::front.email_approve', [
                'SEO' => $this->metaService->getAllTags(null),
                'activation' => $result,
            ]);
        }
    }
}
