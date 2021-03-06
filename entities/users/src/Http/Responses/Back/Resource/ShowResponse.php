<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * ShowResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при показе объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $id = $request->route('user');

        $item = $this->resourceService->getItemById($id);

        return response()->json($item->toArray());
    }
}
