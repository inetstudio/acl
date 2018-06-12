<?php

namespace InetStudio\ACL\Permissions\Observers;

use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Observers\PermissionObserverContract;

/**
 * Class PermissionObserver.
 */
class PermissionObserver implements PermissionObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * PermissionObserver constructor.
     */
    public function __construct()
    {
        $this->services['permissionsObserver'] = app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param PermissionModelContract $item
     */
    public function creating(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param PermissionModelContract $item
     */
    public function created(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param PermissionModelContract $item
     */
    public function updating(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param PermissionModelContract $item
     */
    public function updated(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param PermissionModelContract $item
     */
    public function deleting(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param PermissionModelContract $item
     */
    public function deleted(PermissionModelContract $item): void
    {
        $this->services['permissionsObserver']->deleted($item);
    }
}
