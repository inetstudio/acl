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
        'InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract' => 'InetStudio\ACL\SocialProfiles\Models\SocialProfileModel',
        'InetStudio\ACL\SocialProfiles\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ACL\SocialProfiles\Services\Back\ItemsService',
        'InetStudio\ACL\SocialProfiles\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\SocialProfiles\Services\Front\ItemsService',
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
