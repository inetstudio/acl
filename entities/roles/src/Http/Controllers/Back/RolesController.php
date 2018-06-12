<?php

namespace InetStudio\ACL\Roles\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveRoleRequestContract;
use InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesControllerContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\FormResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\SaveResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\ShowResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\IndexResponseContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\DestroyResponseContract;

/**
 * Class RolesController.
 */
class RolesController extends Controller implements RolesControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->services['roles'] = app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\RolesDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\IndexResponseContract', [
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
        $item = $this->services['roles']->getRoleObject($id);

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\IndexResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Добавление объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['roles']->getRoleObject();

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveRoleRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveRoleRequestContract $request): SaveResponseContract
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
        $item = $this->services['roles']->getRoleObject($id);

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveRoleRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveRoleRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveRoleRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveRoleRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['roles']->save($request, $id);

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\SaveResponseContract', [
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
        $result = $this->services['roles']->destroy($id);

        return app()->makeWith('InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
