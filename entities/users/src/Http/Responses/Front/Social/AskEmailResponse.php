<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Social;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\AskEmailResponseContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class AskEmailResponse.
 */
class AskEmailResponse implements AskEmailResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $metaService;

    /**
     * AskEmailResponse constructor.
     *
     * @param  ItemsServiceContract  $metaService
     */
    public function __construct(ItemsServiceContract $metaService)
    {
        $this->metaService = $metaService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param  Request  $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        if (! Session::has('social_user')) {
            return response()->redirectTo('/');
        } else {
            return view('admin.module.acl.users::front.pages.email')
                ->with(
                    [
                        'SEO' => $this->metaService->getAllTags(null),
                    ]
                );
        }
    }
}
