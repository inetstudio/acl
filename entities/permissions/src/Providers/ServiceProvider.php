<?php

namespace InetStudio\ACL\Permissions\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
    }

    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            'InetStudio\ACL\Permissions\Console\Commands\CreatePermissionsCommand',
            'InetStudio\ACL\Permissions\Console\Commands\SetupCommand',
        ]);
    }

    protected function registerPublishes(): void
    {
        if (! (Schema::hasColumn('permissions', 'package') || Schema::hasColumn('permissions', 'type'))) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes(
                [
                    __DIR__.'/../../database/migrations/add_package_columns_to_permissions_table.php.stub' => database_path('migrations/'.$timestamp.'_add_package_columns_to_permissions_table.php'),
                ],
                'migrations'
            );
        }
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.permissions');
    }

    protected function registerFormComponents()
    {
        FormBuilder::component('permissions', 'admin.module.acl.permissions::back.forms.fields.permissions', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
