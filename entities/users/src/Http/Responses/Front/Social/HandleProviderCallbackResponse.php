<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Social;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract as MetaServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\HandleProviderCallbackResponseContract;

/**
 * Class HandleProviderCallbackResponse.
 */
class HandleProviderCallbackResponse implements HandleProviderCallbackResponseContract
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
     * @param  MetaServiceContract  $metaService
     * @param  SocialServiceContract  $socialService
     */
    public function __construct(SocialServiceContract $socialService, MetaServiceContract $metaService)
    {
        $this->socialService = $socialService;
        $this->metaService = $metaService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $provider = $request->route('provider', '');
        
        $user = $this->socialService->callback($provider);

        if (! $user) {
            return response()->redirectTo('/');
        } elseif (! $user->id) {
            return response()->redirectToRoute('front.acl.users.oauth.email');
        } elseif (! $user->activated) {
            return view(
                'admin.module.acl.activations::front.activate',
                [
                    'SEO' => $this->metaService->getAllTags(null),
                    'activation' => [
                        'success' => false,
                        'message' => trans('admin.module.acl.activations::activation.activationWarning'),
                    ],
                ]
            );
        } else {
            return response()->redirectTo('/');
        }
    }
}
