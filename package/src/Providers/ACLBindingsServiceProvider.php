<?php

namespace InetStudio\ACL\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class ACLBindingsServiceProvider.
 */
class ACLBindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract' => 'InetStudio\ACL\Http\Middleware\Back\AdminAuthenticate',
        'InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract' => 'InetStudio\ACL\Http\Middleware\Back\RedirectIfAuthenticated',
        'InetStudio\ACL\Contracts\Http\Middleware\Front\CheckActivationContract' => 'InetStudio\ACL\Http\Middleware\Front\CheckActivation',
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
