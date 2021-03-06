<?php

namespace InetStudio\ACL\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laratrust\Middleware\LaratrustAbility;
use Laratrust\Middleware\LaratrustPermission;
use Laratrust\Middleware\LaratrustRole;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @param  Router  $router
     */
    public function boot(Router $router): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerViews();
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
            'InetStudio\ACL\Console\Commands\SetupCommand',
        ]);
    }

    /**
     * Регистрация ресурсов.
     */
    protected function registerPublishes(): void
    {
        Config::set('laratrust.models', config('acl.models'));
        Config::set('laratrust.user_models', config('acl.user_models'));
        Config::set('auth.providers.users.model', config('acl.user_models.users'));

        $this->publishes(
            [
                __DIR__.'/../../config/acl.php' => config_path('acl.php'),
            ],
            'config'
        );
    }

    /**
     * Регистрация представлений.
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.acl');
    }

    /**
     * Регистрация посредников.
     *
     * @param  Router  $router
     */
    protected function registerMiddlewares(Router $router): void
    {
        $router->aliasMiddleware('back.auth',
            'InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract');

        $router->aliasMiddleware('back.guest',
            'InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract');

        $router->aliasMiddleware('acl.users.activated',
            'InetStudio\ACL\Contracts\Http\Middleware\Front\CheckActivationContract');

        $router->aliasMiddleware('role', LaratrustRole::class);
        $router->aliasMiddleware('permission', LaratrustPermission::class);
        $router->aliasMiddleware('ability', LaratrustAbility::class);
    }
}
