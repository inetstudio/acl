<?php

namespace InetStudio\ACL\Roles\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class RolesServiceProvider.
 */
class RolesServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
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
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                'InetStudio\ACL\Roles\Console\Commands\SetupCommand',
                'InetStudio\ACL\Roles\Console\Commands\CreateRolesCommand',
            ]);
        }
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.roles');
    }

    /**
     * Регистрация компонентов форм.
     *
     * @return void
     */
    protected function registerFormComponents()
    {
        FormBuilder::component('roles', 'admin.module.acl.roles::back.forms.fields.roles', ['name' => null, 'value' => null, 'attributes' => null]);
    }

    /**
     * Регистрация директив blade.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::if('withoutRole', function ($role) {
            return ! app('laratrust')->hasRole($role);
        });
    }
}
