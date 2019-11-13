<?php

namespace InetStudio\ACL\Passwords\Http\Responses\Front;

use Illuminate\Http\Request;
use InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetFormResponseContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract as SeoServiceContract;

/**
 * Class ResetFormResponse.
 */
class ResetFormResponse implements ResetFormResponseContract
{
    /**
     * @var SeoServiceContract
     */
    protected $seoService;

    /**
     * ResetFormResponse constructor.
     *
     * @param  SeoServiceContract  $seoService
     */
    public function __construct(SeoServiceContract $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $token = $request->route('token');

        if ($request->ajax()) {
            return response()->json($token, 200);
        } else {
            return view('admin.module.acl.passwords::front.reset', [
                'SEO' => $this->seoService->getAllTags(null),
                'token' => $token,
            ]);
        }
    }
}
