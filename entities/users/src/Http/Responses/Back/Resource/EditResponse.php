<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\EditResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class EditResponse.
 */
class EditResponse implements EditResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * EditResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при редактировании объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $id = $request->route('user', 0);

        $item = $this->resourceService->getItemById($id);

        return response()->view('admin.module.acl.users::back.pages.form', compact('item'));
    }
}
