<?php

namespace InetStudio\ACL\Profiles\Services\Front;

use InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Repositories\UsersProfilesRepositoryContract;
use InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesObserverServiceContract;

/**
 * Class UsersProfilesObserverService.
 */
class UsersProfilesObserverService implements UsersProfilesObserverServiceContract
{
    /**
     * @var UsersProfilesRepositoryContract
     */
    private $repository;

    /**
     * UsersProfilesObserverService constructor.
     *
     * @param UsersProfilesRepositoryContract $repository
     */
    public function __construct(UsersProfilesRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param UserProfileModelContract $item
     */
    public function creating(UserProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param UserProfileModelContract $item
     */
    public function created(UserProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserProfileModelContract $item
     */
    public function updating(UserProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserProfileModelContract $item
     */
    public function updated(UserProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserProfileModelContract $item
     */
    public function deleting(UserProfileModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param UserProfileModelContract $item
     */
    public function deleted(UserProfileModelContract $item): void
    {
    }
}
