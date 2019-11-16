<?php

namespace InetStudio\ACL\Users\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  UserModelContract  $model
     */
    public function __construct(UserModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return UserModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): UserModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        $rolesData = Arr::get($data, 'roles', []);
        app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($rolesData, $item);

        $permissionsData = Arr::get($data, 'permissions', []);
        app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($permissionsData, $item);

        event(
            app()->makeWith(
                'InetStudio\ACL\Users\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Пользователь «'.$item['name'].'» успешно '.$action);

        return $item;
    }

    /**
     * Возвращаем статистику объектов по активации.
     *
     * @return mixed
     */
    public function getItemsStatisticByActivation()
    {
        $items = $this->model::buildQuery(
                [
                    'relations' => ['status'],
                ]
            )
            ->select(['activated', DB::raw('count(*) as total')])
            ->groupBy('activated')
            ->get();

        return $items;
    }
}
