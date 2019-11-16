<?php

namespace InetStudio\ACL\Users\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract as UsersServiceContract;

/**
 * Class CreateAdminCommand.
 */
class CreateAdminCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:acl:users:admin';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Create admin user';

    /**
     * @var ItemsServiceContract
     */
    protected $rolesService;

    /**
     * @var UsersServiceContract
     */
    protected $usersService;

    /**
     * CreateAdminCommand constructor.
     *
     * @param ItemsServiceContract $rolesService
     * @param UsersServiceContract $usersService
     */
    public function __construct(ItemsServiceContract $rolesService, UsersServiceContract $usersService)
    {
        parent::__construct();

        $this->rolesService = $rolesService;
        $this->usersService = $usersService;
    }

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $adminRole = $this->rolesService->getModel()->where([['name', '=', 'admin']])->first();

        $user = $this->usersService->getModel()->where([['name', '=', 'admin']])->first();
        $user = $this->usersService->saveModel([
            'activated' => 1,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ], $user ? $user->id : 0);

        DB::table('role_user')->insert(
            ['user_id' => $user->id, 'role_id' => $adminRole->id, 'user_type' => get_class($user)]
        );
    }
}
