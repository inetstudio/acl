<?php

namespace InetStudio\ACL\Roles\Contracts\Services\Back;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
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
     * @return RoleModelContract
     */
    public function save(array $data, int $id): RoleModelContract;

    /**
     * Присваиваем роли объекту.
     *
     * @param $roles
     * @param $item
     */
    public function attachToObject($roles, $item): void;
}
