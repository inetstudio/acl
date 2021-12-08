<?php

namespace InetStudio\Acl\Users\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract as PermissionsServiceContract;

class CreatePermissionsCommand extends Command
{
    protected $name = 'inetstudio:acl:users:permissions:seed';

    protected $description = 'Create acl users permissions';

    public function __construct(
        protected PermissionsServiceContract $permissionsService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $routes = Route::getRoutes();

        $packageName = 'acl.users';

        $prefixes = [
            'back.acl.users',
            'front.acl.users',
            'api.acl.users',
            'other.acl.users',
        ];

        foreach ($routes as $route) {
            $params = $route->action;

            if (! isset($params['as'])) {
                continue;
            }

            if (! Str::startsWith($params['as'], $prefixes)) {
                continue;
            }

            $name = $params['as'];

            $permission = $this->permissionsService->getModel()->where([['name', '=', $name]])->first();

            if (! $permission) {
                $this->permissionsService->save(
                    [
                        'package' => 'acl.users',
                        'scope' => Str::before($params['as'], '.'),
                        'name' => $name,
                        'display_name' => $name,
                        'description' => '',
                    ],
                    0
                );
            }
        }
    }
}
