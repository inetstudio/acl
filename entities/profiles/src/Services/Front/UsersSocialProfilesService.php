<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesServiceContract;
use InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract;

/**
 * Class UsersProfilesService.
 */
class UsersSocialProfilesService implements UsersSocialProfilesServiceContract
{
    /**
     * @var UsersSocialProfilesRepositoryContract
     */
    private $repository;

    /**
     * UsersSocialProfilesService constructor.
     *
     * @param UsersSocialProfilesRepositoryContract $repository
     */
    public function __construct(UsersSocialProfilesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
