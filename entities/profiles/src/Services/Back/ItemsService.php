<?php

namespace InetStudio\ACL\Profiles\Services\Back;

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
}
