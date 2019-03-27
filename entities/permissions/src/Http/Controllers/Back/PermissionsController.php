<?php

namespace InetStudio\ACL\Permissions\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SavePermissionRequestContract;
use InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsControllerContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\ShowResponseContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\DestroyResponseContract;

/**
 * Class PermissionsController.
 */
class PermissionsController extends Controller implements PermissionsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PermissionsController constructor.
     */
    public function __construct()
    {
        $this->services['permissions'] = app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract', [
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
        $item = $this->services['permissions']->getPermissionObject($id);

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract', [
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
        $item = $this->services['permissions']->getPermissionObject();

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SavePermissionRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SavePermissionRequestContract $request): SaveResponseContract
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
        $item = $this->services['permissions']->getPermissionObject($id);

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SavePermissionRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SavePermissionRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SavePermissionRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SavePermissionRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['permissions']->save($request, $id);

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract', [
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
        $result = $this->services['permissions']->destroy($id);

        return app()->makeWith('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\DestroyResponseContract', [
            'result' => ($result === null) ? false : $result,
        ]);
    }
}
