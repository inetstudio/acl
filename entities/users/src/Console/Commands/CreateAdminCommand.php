<?php

namespace InetStudio\ACL\Users\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;

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
     * @var array
     */
    private $repositories;

    /**
     * CreateAdminCommand constructor.
     *
     * @param ItemsServiceContract $rolesService
     * @param UsersRepositoryContract $usersRepository
     */
    public function __construct(ItemsServiceContract $rolesService, UsersRepositoryContract $usersRepository)
    {
        parent::__construct();

        $this->rolesService = $rolesService;
        $this->repositories['users'] = $usersRepository;
    }

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $adminRole = $this->rolesService->getModel()->where([['name', '=', 'admin']])->first();

        $user = $this->repositories['users']->searchItems([['name', '=', 'admin']])->first();
        $user = $this->repositories['users']->save([
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
