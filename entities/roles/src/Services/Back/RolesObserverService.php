<?php

namespace InetStudio\ACL\Roles\Services\Back;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;
use InetStudio\ACL\Roles\Contracts\Services\Back\RolesObserverServiceContract;

/**
 * Class RolesObserverService.
 */
class RolesObserverService implements RolesObserverServiceContract
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
     * Событие "объект создается".
     *
     * @param RoleModelContract $item
     */
    public function creating(RoleModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param RoleModelContract $item
     */
    public function created(RoleModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param RoleModelContract $item
     */
    public function updating(RoleModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param RoleModelContract $item
     */
    public function updated(RoleModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param RoleModelContract $item
     */
    public function deleting(RoleModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param RoleModelContract $item
     */
    public function deleted(RoleModelContract $item): void
    {
    }
}
