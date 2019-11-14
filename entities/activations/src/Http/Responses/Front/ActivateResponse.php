<?php

namespace InetStudio\ACL\Activations\Http\Responses\Front;

use Illuminate\Http\Request;
use InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract as MetaServiceContract;
use InetStudio\ACL\Activations\Contracts\Services\Front\ItemsServiceContract as ActivationsServiceContract;

/**
 * Class ActivateResponse.
 */
class ActivateResponse implements ActivateResponseContract
{
    /**
     * @var ActivationsServiceContract
     */
    protected $activationsService;

    /**
     * @var MetaServiceContract
     */
    protected $metaService;

    /**
     * ActivateResponse constructor.
     *
     * @param  ActivationsServiceContract  $activationsService
     * @param  MetaServiceContract  $metaService
     */
    public function __construct(ActivationsServiceContract $activationsService, MetaServiceContract $metaService)
    {
        $this->activationsService = $activationsService;
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
        $token = $request->route('token');

        $result = $this->activationsService->activate($token);

        if ($request->ajax()) {
            return response()->json($result, 200);
        } else {
            return view('admin.module.acl.activations::front.activate', [
                'SEO' => $this->metaService->getAllTags(null),
                'activation' => $result,
            ]);
        }
    }
}
