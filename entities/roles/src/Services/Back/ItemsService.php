<?php

namespace InetStudio\ACL\Roles\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  RoleModelContract  $model
     */
    public function __construct(RoleModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return RoleModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): RoleModelContract
    {
        $action = ($id) ? 'отредактирована' : 'создана';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        $permissionsData = Arr::get($data, 'permissions', []);
        app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($permissionsData, $item);

        event(
            app()->makeWith(
                'InetStudio\ACL\Roles\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Роль «'.$item['display_name'].'» успешно '.$action);

        return $item;
    }

    /**
     * Присваиваем роли объекту.
     *
     * @param $roles
     * @param $item
     */
    public function attachToObject($roles, $item): void
    {
        if ($roles instanceof Request) {
            $roles = $roles->get('roles', []);
        } else {
            $roles = (array) $roles;
        }

        if (! empty($roles)) {
            $item->syncRoles($this->model::whereIn('id', $roles)->get());
        } else {
            $item->detachRoles($item['roles']);
        }
    }
}
