<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract;
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

    /**
     * Сохраняем профайл пользователя.
     *
     * @param array $data
     * @param int $id
     *
     * @return UserProfileModelContract
     */
    public function save(array $data, int $id = 0): UserProfileModelContract
    {
        $profile = $this->repository->save($data, $id);

        return $profile;
    }
}
