<?php

namespace InetStudio\ACL\Profiles\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Profiles\Contracts\Models\ProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Services\Back\ItemsServiceContract;

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
}
