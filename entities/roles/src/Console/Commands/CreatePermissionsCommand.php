<?php

namespace InetStudio\Acl\Roles\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract as PermissionsServiceContract;

class CreatePermissionsCommand extends Command
{
    protected $name = 'inetstudio:acl:roles:permissions:seed';

    protected $description = 'Create acl roles permissions';

    protected array $permissions = [
        'acl.roles.create' => [
            'display_name' => 'Создание ролей',
            'description' => '',
        ],
        'acl.roles.read' => [
            'display_name' => 'Чтение ролей',
            'description' => '',
        ],
        'acl.roles.update' => [
            'display_name' => 'Обновление ролей',
            'description' => '',
        ],
        'acl.roles.delete' => [
            'display_name' => 'Удаление ролей',
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
