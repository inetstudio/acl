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
}
