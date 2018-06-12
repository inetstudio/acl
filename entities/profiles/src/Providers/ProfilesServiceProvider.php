<?php

namespace InetStudio\ACL\Profiles\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ProfilesServiceProvider.
 */
class ProfilesServiceProvider extends ServiceProvider
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
                'InetStudio\ACL\Profiles\Console\Commands\SetupCommand',
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
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateACLProfilesTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_acl_profiles_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_acl_profiles_tables.php'),
                ], 'migrations');
            }
        }
    }
}
