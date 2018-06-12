<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract;
use InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesObserverServiceContract;

/**
 * Class UsersSocialProfilesObserverService.
 */
class UsersSocialProfilesObserverService implements UsersSocialProfilesObserverServiceContract
{
    /**
     * @var UsersSocialProfilesRepositoryContract
     */
    private $repository;

    /**
     * PermissionsService constructor.
     *
     * @param UsersSocialProfilesRepositoryContract $repository
     */
    public function __construct(UsersSocialProfilesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function creating(UserSocialProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function created(UserSocialProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function updating(UserSocialProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function updated(UserSocialProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function deleting(UserSocialProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function deleted(UserSocialProfileModelContract $item): void
    {
    }
}
