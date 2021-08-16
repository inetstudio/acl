<?php

namespace InetStudio\Acl\Permissions\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract as PermissionsServiceContract;

class CreatePermissionsCommand extends Command
{
    protected $name = 'inetstudio:acl:permissions:seed';

    protected $description = 'Create permissions';

    protected array $permissions = [
        'acl.permissions.create' => [
            'display_name' => 'Создание прав',
            'description' => '',
        ],
        'acl.permissions.read' => [
            'display_name' => 'Чтение прав',
            'description' => '',
        ],
        'acl.permissions.update' => [
            'display_name' => 'Обновление прав',
            'description' => '',
        ],
        'acl.permissions.delete' => [
            'display_name' => 'Удаление прав',
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
