<?php

namespace InetStudio\ACL\Roles\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

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
        $id = $request->route('code', 0);
        $data = $request->all();

        $item = $this->resourceService->save($data, $id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $item['id'],
            ], 200);
        } else {
            return response()->redirectToRoute(
                'back.acl.roles.edit',
                [
                    $item['id'],
                ]
            );
        }
    }
}
