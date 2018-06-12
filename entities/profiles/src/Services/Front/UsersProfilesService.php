<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use InetStudio\ACL\Profiles\Contracts\Repositories\UsersProfilesRepositoryContract;
use InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesServiceContract;

/**
 * Class UsersProfilesService.
 */
class UsersProfilesService implements UsersProfilesServiceContract
{
    /**
     * @var UsersProfilesRepositoryContract
     */
    private $repository;

    /**
     * ProfilesService constructor.
     *
     * @param UsersProfilesRepositoryContract $repository
     */
    public function __construct(UsersProfilesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
