<?php

namespace InetStudio\ACL\Permissions\Services\Back;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param PermissionModelContract $model
     */
    public function __construct(PermissionModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return PermissionModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): PermissionModelContract
    {
        $action = ($id) ? 'отредактировано' : 'создано';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        event(
            app()->make(
                'InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Право «'.$item['display_name'].'» успешно '.$action);

        return $item;
    }

    /**
     * Присваиваем права объекту.
     *
     * @param $permissions
     * @param $item
     */
    public function attachToObject($permissions, $item)
    {
        if ($permissions instanceof Request) {
            $permissions = $permissions->get('permissions', []);
        } else {
            $permissions = (array) $permissions;
        }

        if (! empty($permissions)) {
            $item->syncPermissions($this->model::whereIn('id', $permissions)->get());
        } else {
            $item->detachPermissions($item['permissions']);
        }
    }
}
