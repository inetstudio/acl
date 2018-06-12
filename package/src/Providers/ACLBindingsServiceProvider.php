<?php

namespace InetStudio\ACL\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ACLBindingsServiceProvider.
 */
class ACLBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Middleware
        'InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract' => 'InetStudio\ACL\Http\Middleware\Back\AdminAuthenticate',
        'InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract' => 'InetStudio\ACL\Http\Middleware\Back\RedirectIfAuthenticated',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract',
            'InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract',
        ];
    }
}
