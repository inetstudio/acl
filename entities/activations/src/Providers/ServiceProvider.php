<?php

namespace InetStudio\ACL\Activations\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
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
    public function boot(Router $router): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerEvents();
        $this->registerMiddlewares($router);
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
            'InetStudio\ACL\Activations\Console\Commands\SetupCommand',
        ]);
    }

    /**
     * Регистрация ресурсов.
     */
    protected function registerPublishes(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        if (Schema::hasTable('users_activations')) {
            return;
        }

        $timestamp = date('Y_m_d_His', time());
        $this->publishes(
            [
                __DIR__.'/../../database/migrations/create_acl_activations_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_acl_activations_tables.php'),
            ],
            'migrations'
        );
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl.activations');
    }

    /**
     * Регистрация переводов.
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin.module.acl.activations');
    }

    /**
     * Регистрация событий.
     */
    protected function registerEvents(): void
    {
        Event::listen(
            'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract',
            'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract'
        );

        Event::listen(
            'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract',
            'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract'
        );
    }

    protected function registerMiddlewares(Router $router): void
    {
        $router->aliasMiddleware(
            'acl.users.activated',
            'InetStudio\ACL\Activations\Contracts\Http\Middleware\Front\CheckActivationContract'
        );
    }
}
