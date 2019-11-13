<?php

namespace InetStudio\ACL\Roles\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Загрузка сервиса.
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
        $this->registerBladeDirectives();
    }

    /**
     * Регистрация команд.
     */
    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            'InetStudio\ACL\Roles\Console\Commands\SetupCommand',
            'InetStudio\ACL\Roles\Console\Commands\CreateRolesCommand',
        ]);
    }

    /**
     * Регистрация путей.
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.roles');
    }

    /**
     * Регистрация компонентов форм.
     */
    protected function registerFormComponents(): void
    {
        FormBuilder::component('roles', 'admin.module.acl.roles::back.forms.fields.roles', ['name' => null, 'value' => null, 'attributes' => null]);
    }

    /**
     * Регистрация директив blade.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::if('withoutRole', function ($role) {
            return ! app('laratrust')->hasRole($role);
        });
    }
}
