<?php

namespace InetStudio\ACL\SocialProfiles\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract;
use InetStudio\ACL\SocialProfiles\Contracts\Services\Back\ItemsServiceContract;

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
}
