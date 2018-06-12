<?php

namespace InetStudio\ACL\Profiles\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ProfilesBindingsServiceProvider.
 */
class ProfilesBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Models
        'InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract' => 'InetStudio\ACL\Profiles\Models\UserProfileModel',
        'InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract' => 'InetStudio\ACL\Profiles\Models\UserSocialProfileModel',

        // Observers
        'InetStudio\ACL\Profiles\Contracts\Observers\UserProfileObserverContract' => 'InetStudio\ACL\Profiles\Observers\UserProfileObserver',
        'InetStudio\ACL\Profiles\Contracts\Observers\UserSocialProfileObserverContract' => 'InetStudio\ACL\Profiles\Observers\UserSocialProfileObserver',

        // Repositories
        'InetStudio\ACL\Profiles\Contracts\Repositories\UsersProfilesRepositoryContract' => 'InetStudio\ACL\Profiles\Repositories\UsersProfilesRepository',
        'InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract' => 'InetStudio\ACL\Profiles\Repositories\UsersSocialProfilesRepository',

        // Services
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesObserverServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersProfilesObserverService',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersProfilesService',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesObserverServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersSocialProfilesObserverService',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersSocialProfilesService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract',
            'InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract',
            'InetStudio\ACL\Profiles\Contracts\Observers\UserProfileObserverContract',
            'InetStudio\ACL\Profiles\Contracts\Observers\UserSocialProfileObserverContract',
            'InetStudio\ACL\Profiles\Contracts\Repositories\UsersProfilesRepositoryContract',
            'InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract',
            'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesObserverServiceContract',
            'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesServiceContract',
            'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesObserverServiceContract',
            'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesServiceContract',
        ];
    }
}
