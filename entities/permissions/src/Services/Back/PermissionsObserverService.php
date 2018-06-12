<?php

namespace InetStudio\ACL\Permissions\Services\Back;

use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract;
use InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsObserverServiceContract;

/**
 * Class PermissionsObserverService.
 */
class PermissionsObserverService implements PermissionsObserverServiceContract
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
     * Событие "объект создается".
     *
     * @param PermissionModelContract $item
     */
    public function creating(PermissionModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param PermissionModelContract $item
     */
    public function created(PermissionModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param PermissionModelContract $item
     */
    public function updating(PermissionModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param PermissionModelContract $item
     */
    public function updated(PermissionModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param PermissionModelContract $item
     */
    public function deleting(PermissionModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param PermissionModelContract $item
     */
    public function deleted(PermissionModelContract $item): void
    {
    }
}
