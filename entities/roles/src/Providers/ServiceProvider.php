<?php

namespace InetStudio\ACL\Roles\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
        $this->registerBladeDirectives();
    }

    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            'InetStudio\ACL\Roles\Console\Commands\CreatePermissionsCommand',
            'InetStudio\ACL\Roles\Console\Commands\CreateRolesCommand',
            'InetStudio\ACL\Roles\Console\Commands\SetupCommand',
        ]);
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.roles');
    }

    protected function registerFormComponents(): void
    {
        FormBuilder::component('roles', 'admin.module.acl.roles::back.forms.fields.roles', ['name' => null, 'value' => null, 'attributes' => null]);
    }

    protected function registerBladeDirectives(): void
    {
        Blade::if('withoutRole', function ($role) {
            return ! app('laratrust')->hasRole($role);
        });
    }
}
