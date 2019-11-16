<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\CreateResponseContract;

/**
 * Class CreateResponse.
 */
class CreateResponse implements CreateResponseContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $resourceService;

    /**
     * CreateResponse constructor.
     *
     * @param  ItemsServiceContract  $resourceService
     */
    public function __construct(ItemsServiceContract $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    /**
     * Возвращаем ответ при создании объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|null
     */
    public function toResponse($request)
    {
        $item = $this->resourceService->getItemById();

        return response()->view('admin.module.acl.users::back.pages.form', compact('item'));
    }
}
