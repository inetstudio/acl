<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\ShowResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\DestroyResponseContract;

/**
 * Class UsersController.
 */
class UsersController extends Controller implements UsersControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Back\UsersDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract', [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(int $id = 0): ShowResponseContract
    {
        $item = $this->services['users']->getUserObject($id);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Создание объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['users']->getUserObject();

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveUserRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveUserRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit($id = 0): FormResponseContract
    {
        $item = $this->services['users']->getUserObject($id);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveUserRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveUserRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveUserRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveUserRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['users']->save($request, $id);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['users']->destroy($id);

        return app()->makeWith('InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
