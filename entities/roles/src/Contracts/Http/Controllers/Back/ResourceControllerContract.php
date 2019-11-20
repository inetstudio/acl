<?php

namespace InetStudio\ACL\Roles\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveItemRequestContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\CreateResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\EditResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

/**
 * Interface ResourceControllerContract.
 */
interface ResourceControllerContract
{
    /**
     * Список объектов.
     *
     * @param  Request  $request
     * @param  IndexResponseContract  $response
     *
     * @return IndexResponseContract
     */
    public function index(Request $request, IndexResponseContract $response): IndexResponseContract;

    /**
     * Создание объекта.
     *
     * @param  Request  $request
     * @param  CreateResponseContract  $response
     *
     * @return CreateResponseContract
     */
    public function create(Request $request, CreateResponseContract $response): CreateResponseContract;

    /**
     * Создание объекта.
     *
     * @param  SaveItemRequestContract  $request
     * @param  SaveResponseContract  $response
     *
     * @return SaveResponseContract
     */
    public function store(SaveItemRequestContract $request, SaveResponseContract $response): SaveResponseContract;

    /**
     * Получение объекта.
     *
     * @param  Request  $request
     * @param  ShowResponseContract  $response
     *
     * @return ShowResponseContract
     */
    public function show(Request $request, ShowResponseContract $response): ShowResponseContract;

    /**
     * Редактирование объекта.
     *
     * @param  Request  $request
     * @param  EditResponseContract  $response
     *
     * @return EditResponseContract
     */
    public function edit(Request $request, EditResponseContract $response): EditResponseContract;

    /**
     * Обновление объекта.
     *
     * @param  SaveItemRequestContract  $request
     * @param  SaveResponseContract  $response
     *
     * @return SaveResponseContract
     */
    public function update(SaveItemRequestContract $request, SaveResponseContract $response): SaveResponseContract;

    /**
     * Удаление объекта.
     *
     * @param  Request  $request
     * @param  DestroyResponseContract  $response
     *
     * @return DestroyResponseContract
     */
    public function destroy(Request $request, DestroyResponseContract $response): DestroyResponseContract;
}
