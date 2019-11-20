<?php

namespace InetStudio\ACL\Users\Services\Back;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    protected $colors = [
        0 => 'warning',
        1 => 'primary',
    ];

    protected $titles = [
        0 => 'Неактивные',
        1 => 'Активные',
    ];

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

    /**
     * Возвращаем цвета активаций.
     *
     * @return array
     */
    public function getActivationsColors(): array
    {
        return $this->colors;
    }

    /**
     * Возвращаем заголовки активаций.
     *
     * @return array
     */
    public function getActivationsTitles(): array
    {
        return $this->titles;
    }
}
