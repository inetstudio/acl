<?php

namespace InetStudio\ACL\SocialProfiles\Services\Front;

use Illuminate\Support\Arr;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract;
use InetStudio\ACL\SocialProfiles\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  SocialProfileModelContract  $model
     */
    public function __construct(SocialProfileModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return SocialProfileModelContract
     */
    public function save(array $data, int $id): SocialProfileModelContract
    {
        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        return $item;
    }
}
