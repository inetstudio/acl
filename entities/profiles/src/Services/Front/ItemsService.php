<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use Illuminate\Support\Arr;
use InetStudio\ACL\Profiles\Contracts\Models\ProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  ProfileModelContract  $model
     */
    public function __construct(ProfileModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return ProfileModelContract
     */
    public function save(array $data, int $id): ProfileModelContract
    {
        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        return $item;
    }
}
