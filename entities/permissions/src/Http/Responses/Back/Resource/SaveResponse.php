<?php

namespace InetStudio\ACL\Permissions\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * SaveResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $id = $request->route('permission', 0);
        $data = $request->all();

        $item = $this->resourceService->save($data, $id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $item['id'],
            ], 200);
        } else {
            return response()->redirectToRoute(
                'back.acl.permissions.edit',
                [
                    $item['id'],
                ]
            );
        }
    }
}
