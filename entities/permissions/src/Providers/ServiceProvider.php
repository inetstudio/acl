<?php

namespace InetStudio\ACL\Permissions\Providers;

use Collective\Html\FormBuilder;
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
        $this->registerRoutes();
        $this->registerViews();
        $this->registerFormComponents();
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.permissions');
    }

    /**
     * Регистрация компонентов форм.
     */
    protected function registerFormComponents()
    {
        FormBuilder::component('permissions', 'admin.module.acl.permissions::back.forms.fields.permissions', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
