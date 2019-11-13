<?php

namespace InetStudio\ACL\SocialProfiles\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\SocialProfiles\Contracts\Models\UserProfileModelContract' => 'InetStudio\ACL\SocialProfiles\Models\UserProfileModel',
        'InetStudio\ACL\SocialProfiles\Contracts\Models\UserSocialProfileModelContract' => 'InetStudio\ACL\SocialProfiles\Models\UserSocialProfileModel',
        'InetStudio\ACL\SocialProfiles\Contracts\Services\Front\UsersProfilesServiceContract' => 'InetStudio\ACL\SocialProfiles\Services\Front\UsersProfilesService',
        'InetStudio\ACL\SocialProfiles\Contracts\Services\Front\UsersSocialProfilesServiceContract' => 'InetStudio\ACL\SocialProfiles\Services\Front\UsersSocialProfilesService',
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
