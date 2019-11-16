<?php

namespace InetStudio\ACL\Users\Contracts\Services\Back;

use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return UserModelContract
     */
    public function save(array $data, int $id): UserModelContract;
}
