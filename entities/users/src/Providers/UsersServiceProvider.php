<?php

namespace InetStudio\ACL\Users\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class UsersServiceProvider.
 */
class UsersServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerViewComposers();
        $this->registerFormComponents();
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
                'InetStudio\ACL\Users\Console\Commands\CreateAdminCommand',
                'InetStudio\ACL\Users\Console\Commands\CreateFoldersCommand',
                'InetStudio\ACL\Users\Console\Commands\SetupCommand',
            ]);
        }
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
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

        if (Schema::hasColumn('users', 'user_hash') || Schema::hasColumn('users', 'referer_id')) {
            return;
        }

        $timestamp = date('Y_m_d_His', time());
        $this->publishes(
            [
                __DIR__.'/../../database/migrations/create_referrals_columns.php.stub' => database_path('migrations/'.$timestamp.'_create_referrals_columns.php'),
            ],
            'migrations'
        );
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.users');
    }

    /**
     * Регистрация переводов.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin.module.acl.users');
    }

    /**
     * Register Users's view composers.
     *
     * @return void
     */
    public function registerViewComposers(): void
    {
        view()->composer('admin.module.acl.users::back.partials.analytics.statistic', function ($view) {
            $registrations = app()->make('InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract')
                ->getAllItems(true)
                ->select(['activated', DB::raw('count(*) as total')])
                ->groupBy('activated')
                ->get();

            $view->with('registrations', $registrations);
        });
    }

    /**
     * Регистрация компонентов форм.
     *
     * @return void
     */
    protected function registerFormComponents()
    {
        FormBuilder::component('user', 'admin.module.acl.users::back.forms.fields.user', ['name' => null, 'value' => null, 'attributes' => null]);
    }
}
