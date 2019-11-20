<?php

namespace InetStudio\ACL\Roles\Services\Front;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

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
}
