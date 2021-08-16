<?php

namespace InetStudio\ACL\Roles\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;

class CreateRolesCommand extends Command
{
    protected $name = 'inetstudio:acl:roles:seed';

    protected $description = 'Create acl roles';

    public function __construct(
        protected ItemsServiceContract $rolesService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        Config::set('laratrust.user_models', [
            'users' => 'InetStudio\ACL\Users\Models\UserModel',
        ]);

        $adminRole = $this->rolesService->getModel()->where([['name', '=', 'admin']])->first();
        if (! $adminRole) {
            $this->rolesService->save(
                [
                    'name' => 'admin',
                    'display_name' => 'Администратор',
                    'description' => 'Пользователь, у которого есть доступ в административную панель.',
                ],
                0
            );
        }

        $userRole = $this->rolesService->getModel()->where([['name', '=', 'user']])->first();
        if (! $userRole) {
            $this->rolesService->save(
                [
                    'name' => 'user',
                    'display_name' => 'Пользователь',
                    'description' => 'Пользователь, зарегистрировавшийся через сайт.',
                ],
                0
            );
        }

        $socialUserRole = $this->rolesService->getModel()->where([['name', '=', 'social_user']])->first();
        if (! $socialUserRole) {
            $this->rolesService->save(
                [
                    'name' => 'social_user',
                    'display_name' => 'Пользователь социальной сети',
                    'description' => 'Пользователь, зарегистрировавшийся через социальную сеть.',
                ],
                0
            );
        }
    }
}
