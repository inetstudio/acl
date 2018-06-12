<?php

namespace InetStudio\ACL\Users\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;
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
     * @var array
     */
    private $repositories;

    /**
     * CreateAdminCommand constructor.
     *
     * @param RolesRepositoryContract $rolesRepository
     * @param UsersRepositoryContract $usersRepository
     */
    public function __construct(RolesRepositoryContract $rolesRepository, UsersRepositoryContract $usersRepository)
    {
        parent::__construct();

        $this->repositories['roles'] = $rolesRepository;
        $this->repositories['users'] = $usersRepository;
    }

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $adminRole = $this->repositories['roles']->searchItemsByField('name', 'admin')->first();
        $user = $this->repositories['users']->searchItemsByField('name', 'admin')->first();
        $user = $this->repositories['users']->save([
            'activated' => 1,
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ], $user ? $user->id : 0);

        $user->syncRoles([$adminRole->id]);
    }
}
