<?php

namespace InetStudio\ACL\Roles\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class BladeServiceProvider.
 */
class BladeServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::if('withoutRole', function ($role) {
            return ! app('laratrust')->hasRole($role);
        });
    }
}
