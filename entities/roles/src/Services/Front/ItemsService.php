<?php

namespace InetStudio\ACL\Roles\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Services\Front\ItemsServiceContract;

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
