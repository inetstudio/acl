<?php

namespace InetStudio\ACL\Permissions\Services\Front;

use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  PermissionModelContract  $model
     */
    public function __construct(PermissionModelContract $model)
    {
        parent::__construct($model);
    }
}
