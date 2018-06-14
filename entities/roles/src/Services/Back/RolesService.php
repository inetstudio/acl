<?php

namespace InetStudio\ACL\Roles\Services\Back;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;
use InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveRoleRequestContract;

/**
 * Class RolesService.
 */
class RolesService implements RolesServiceContract
{
    /**
     * @var RolesRepositoryContract
     */
    private $repository;

    /**
     * RolesService constructor.
     *
     * @param RolesRepositoryContract $repository
     */
    public function __construct(RolesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return RoleModelContract
     */
    public function getRoleObject(int $id = 0)
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
    public function getRolesByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveRoleRequestContract $request
     * @param int $id
     *
     * @return RoleModelContract
     */
    public function save(SaveRoleRequestContract $request, int $id): RoleModelContract
    {
        $action = ($id) ? 'отредактирована' : 'создана';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract')
            ->attachToObject($request, $item);

        event(app()->makeWith('InetStudio\ACL\Roles\Contracts\Events\Back\ModifyRoleEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Роль «'.$item->display_name.'» успешно '.$action);

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
     * Присваиваем роли объекту.
     *
     * @param $request
     *
     * @param $item
     */
    public function attachToObject($request, $item)
    {
        $item->syncRoles(collect($request->get('roles'))->toArray());
    }
}
