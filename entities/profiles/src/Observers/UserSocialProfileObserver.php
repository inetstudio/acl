<?php

namespace InetStudio\ACL\Profiles\Observers;

use InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract;
use InetStudio\ACL\Profiles\Contracts\Observers\UserSocialProfileObserverContract;

/**
 * Class UserSocialProfileObserver.
 */
class UserSocialProfileObserver implements UserSocialProfileObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * UserSocialProfileObserver constructor.
     */
    public function __construct()
    {
        $this->services['usersSocialProfilesObserver'] = app()->make('InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function creating(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function created(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function updating(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function updated(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function deleting(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param UserSocialProfileModelContract $item
     */
    public function deleted(UserSocialProfileModelContract $item): void
    {
        $this->services['usersSocialProfilesObserver']->deleted($item);
    }
}
