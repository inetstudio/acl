<?php

namespace InetStudio\ACL\Passwords\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $this->registerTranslations();
        $this->registerValidators();
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.passwords');
    }

    /**
     * Регистрация переводов.
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin.module.acl.passwords');
    }

    /**
     * Регистрация валидаторов.
     */
    protected function registerValidators(): void
    {
        Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return ($value == '' || Hash::check($value, current($parameters)));
        });
    }
}
