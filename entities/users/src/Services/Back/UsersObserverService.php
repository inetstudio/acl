<?php

namespace InetStudio\ACL\Users\Services\Back;

use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;
use InetStudio\ACL\Users\Contracts\Services\Back\UsersObserverServiceContract;

/**
 * Class UsersObserverService.
 */
class UsersObserverService implements UsersObserverServiceContract
{
    /**
     * @var UsersRepositoryContract
     */
    private $repository;

    /**
     * UsersService constructor.
     *
     * @param UsersRepositoryContract $repository
     */
    public function __construct(UsersRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param UserModelContract $item
     */
    public function creating(UserModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param UserModelContract $item
     */
    public function created(UserModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserModelContract $item
     */
    public function updating(UserModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserModelContract $item
     */
    public function updated(UserModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserModelContract $item
     */
    public function deleting(UserModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param UserModelContract $item
     */
    public function deleted(UserModelContract $item): void
    {
    }
}
