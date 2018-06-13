<?php

namespace InetStudio\ACL\Roles\Services\Front;

use InetStudio\ACL\Roles\Contracts\Services\Front\RolesServiceContract;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;

/**
 * Class RolesService.
 */
class RolesService implements RolesServiceContract
{
    /**
     * @var RolesRepositoryContract
     */
    private $repository;

    /**
     * RolesService constructor.
     *
     * @param RolesRepositoryContract $repository
     */
    public function __construct(RolesRepositoryContract $repository)
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
    public function getRolesByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }
}
