<?php

namespace InetStudio\ACL\Profiles\Providers;

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
        'InetStudio\ACL\Profiles\Contracts\Listeners\Front\CreateProfileListenerContract' => 'InetStudio\ACL\Profiles\Listeners\Front\CreateProfileListener',
        'InetStudio\ACL\Profiles\Contracts\Models\ProfileModelContract' => 'InetStudio\ACL\Profiles\Models\ProfileModel',
        'InetStudio\ACL\Profiles\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ACL\Profiles\Services\Back\ItemsService',
        'InetStudio\ACL\Profiles\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Profiles\Services\Front\ItemsService',
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
