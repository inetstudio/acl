<?php

namespace InetStudio\ACL\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        'InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract' => 'InetStudio\ACL\Http\Middleware\Back\AdminAuthenticate',
        'InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract' => 'InetStudio\ACL\Http\Middleware\Back\RedirectIfAuthenticated',
    ];

    public function provides()
    {
        return array_keys($this->bindings);
    }
}
