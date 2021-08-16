<?php

namespace InetStudio\Acl\Users\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract as PermissionsServiceContract;

class CreatePermissionsCommand extends Command
{
    protected $name = 'inetstudio:acl:users:permissions:seed';

    protected $description = 'Create acl users permissions';

    protected array $permissions = [
        'acl.users.create' => [
            'display_name' => 'Создание пользователей',
            'description' => '',
        ],
        'acl.users.read' => [
            'display_name' => 'Чтение пользователей',
            'description' => '',
        ],
        'acl.users.update' => [
            'display_name' => 'Обновление пользователей',
            'description' => '',
        ],
        'acl.users.delete' => [
            'display_name' => 'Удаление пользователей',
            'description' => '',
        ],
    ];

    public function __construct(
        protected PermissionsServiceContract $permissionsService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        foreach ($this->permissions as $name => $permissionData) {
            $permission = $this->permissionsService->getModel()->where([['name', '=', $name]])->first();

            if (! $permission) {
                $this->permissionsService->save(
                    [
                        'name' => $name,
                        'display_name' => $permissionData['display_name'],
                        'description' => $permissionData['description'],
                    ],
                    0
                );
            }
        }
    }
}
