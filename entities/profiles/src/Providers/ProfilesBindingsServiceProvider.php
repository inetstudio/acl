<?php

namespace InetStudio\ACL\Profiles\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ProfilesBindingsServiceProvider.
 */
class ProfilesBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract' => 'InetStudio\ACL\Profiles\Models\UserProfileModel',
        'InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract' => 'InetStudio\ACL\Profiles\Models\UserSocialProfileModel',
        'InetStudio\ACL\Profiles\Contracts\Repositories\UsersProfilesRepositoryContract' => 'InetStudio\ACL\Profiles\Repositories\UsersProfilesRepository',
        'InetStudio\ACL\Profiles\Contracts\Repositories\UsersSocialProfilesRepositoryContract' => 'InetStudio\ACL\Profiles\Repositories\UsersSocialProfilesRepository',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersProfilesServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersProfilesService',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\UsersSocialProfilesServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\UsersSocialProfilesService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
