<?php

namespace InetStudio\ACL\Users\Observers;

use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Observers\UserObserverContract;

/**
 * Class UserObserver.
 */
class UserObserver implements UserObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * UserObserver constructor.
     */
    public function __construct()
    {
        $this->services['usersObserver'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Back\UsersObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param UserModelContract $item
     */
    public function creating(UserModelContract $item): void
    {
        $this->services['usersObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param UserModelContract $item
     */
    public function created(UserModelContract $item): void
    {
        $this->services['usersObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserModelContract $item
     */
    public function updating(UserModelContract $item): void
    {
        $this->services['usersObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserModelContract $item
     */
    public function updated(UserModelContract $item): void
    {
        $this->services['usersObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserModelContract $item
     */
    public function deleting(UserModelContract $item): void
    {
        $this->services['usersObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param UserModelContract $item
     */
    public function deleted(UserModelContract $item): void
    {
        $this->services['usersObserver']->deleted($item);
    }
}
