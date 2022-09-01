<?php

namespace InetStudio\ACL\Users\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\Schema;
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
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerFormComponents();
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
            'InetStudio\ACL\Users\Console\Commands\CreateAdminCommand',
            'InetStudio\ACL\Users\Console\Commands\CreateFoldersCommand',
            'InetStudio\ACL\Users\Console\Commands\CreatePermissionsCommand',
            'InetStudio\ACL\Users\Console\Commands\SetupCommand',
        ]);
    }

    /**
     * Регистрация ресурсов.
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/acl_users.php' => config_path('acl_users.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/services.php', 'services'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../../config/filesystems.php', 'filesystems.disks'
        );

        if (! (Schema::hasColumn('users', 'user_hash') || Schema::hasColumn('users', 'referrer_id'))) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes(
                [
                    __DIR__.'/../../database/migrations/add_referrals_columns_to_users_table.php.stub' => database_path('migrations/'.$timestamp.'_add_referrals_columns_to_users_table.php'),
                ],
                'migrations'
            );
        }
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.users');
    }

    /**
     * Регистрация переводов.
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin.module.acl.users');
    }

    /**
     * Регистрация компонентов форм.
     */
    protected function registerFormComponents()
    {
        FormBuilder::component(
            'user',
            'admin.module.acl.users::back.forms.fields.user',
            ['name' => null, 'value' => null, 'attributes' => null]
        );
    }
}
