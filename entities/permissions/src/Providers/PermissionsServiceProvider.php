<?php

namespace InetStudio\ACL\Permissions\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

/**
 * Class PermissionsServiceProvider.
 */
class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.permissions');
    }

    /**
     * Регистрация компонентов форм.
     *
     * @return void
     */
    protected function registerFormComponents()
    {
        FormBuilder::component('permissions', 'admin.module.acl.permissions::back.forms.fields.permissions', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
