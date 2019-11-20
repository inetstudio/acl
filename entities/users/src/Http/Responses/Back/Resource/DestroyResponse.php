<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class DestroyResponse.
 */
class DestroyResponse implements DestroyResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * DestroyResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $id = $request->route('user');

        $result = $this->resourceService->destroy($id);

        return response()->json(
            [
                'success' => $result,
            ]
        );
    }
}
