<?php

namespace InetStudio\ACL\Permissions\Services\Back;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract;
use InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract;
use InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SavePermissionRequestContract;

/**
 * Class PermissionsService.
 */
class PermissionsService implements PermissionsServiceContract
{
    /**
     * @var PermissionsRepositoryContract
     */
    private $repository;

    /**
     * PermissionsService constructor.
     *
     * @param PermissionsRepositoryContract $repository
     */
    public function __construct(PermissionsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return PermissionModelContract
     */
    public function getPermissionObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getPermissionsByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SavePermissionRequestContract $request
     * @param int $id
     *
     * @return PermissionModelContract
     */
    public function save(SavePermissionRequestContract $request, int $id): PermissionModelContract
    {
        $action = ($id) ? 'отредактировано' : 'создано';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        event(app()->makeWith('InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyPermissionEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Право «'.$item->display_name.'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     *
     * @return Collection
     */
    public function getSuggestions(string $search): Collection
    {
        $items = $this->repository->searchItems([['display_name', 'LIKE', '%'.$search.'%']]);

        return $items;
    }

    /**
     * Присваиваем права объекту.
     *
     * @param $request
     *
     * @param $item
     */
    public function attachToObject($request, $item)
    {
        $item->syncPermissions(collect($request->get('permissions'))->toArray());
    }
}
