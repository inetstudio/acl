<?php

namespace InetStudio\ACL\Profiles\Observers;

use InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Observers\UserProfileObserverContract;

/**
 * Class UserProfileObserver.
 */
class UserProfileObserver implements UserProfileObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * UserProfileObserver constructor.
     */
    public function __construct()
    {
        $this->services['usersProfilesObserver'] = app()->make('InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param UserProfileModelContract $item
     */
    public function creating(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param UserProfileModelContract $item
     */
    public function created(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserProfileModelContract $item
     */
    public function updating(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserProfileModelContract $item
     */
    public function updated(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserProfileModelContract $item
     */
    public function deleting(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param UserProfileModelContract $item
     */
    public function deleted(UserProfileModelContract $item): void
    {
        $this->services['usersProfilesObserver']->deleted($item);
    }
}
