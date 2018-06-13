<?php

namespace InetStudio\ACL\Permissions\Services\Front;

use InetStudio\ACL\Permissions\Contracts\Services\Front\PermissionsServiceContract;
use InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract;

/**
 * Class PermissionsService.
 */
class PermissionsService implements PermissionsServiceContract
{
    /**
     * @var PermissionsRepositoryContract
     */
    private $repository;

    /**
     * PermissionsService constructor.
     *
     * @param PermissionsRepositoryContract $repository
     */
    public function __construct(PermissionsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getPermissionsByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }
}
