<?php

namespace InetStudio\ACL\Roles\Observers;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Observers\RoleObserverContract;

/**
 * Class RoleObserver.
 */
class RoleObserver implements RoleObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * RoleObserver constructor.
     */
    public function __construct()
    {
        $this->services['rolesObserver'] = app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\RolesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param RoleModelContract $item
     */
    public function creating(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param RoleModelContract $item
     */
    public function created(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param RoleModelContract $item
     */
    public function updating(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param RoleModelContract $item
     */
    public function updated(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param RoleModelContract $item
     */
    public function deleting(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param RoleModelContract $item
     */
    public function deleted(RoleModelContract $item): void
    {
        $this->services['rolesObserver']->deleted($item);
    }
}
