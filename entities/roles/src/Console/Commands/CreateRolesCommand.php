<?php

namespace InetStudio\ACL\Roles\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;

/**
 * Class CreateRolesCommand.
 */
class CreateRolesCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:acl:roles:seed';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Create acl roles';

    /**
     * @var RolesRepositoryContract
     */
    private $repository;

    /**
     * CreateRolesCommand constructor.
     *
     * @param RolesRepositoryContract $repository
     */
    public function __construct(RolesRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Запуск команды.
     *
     * @return void
     */
    public function handle(): void
    {
        $adminRole = $this->repository->searchItems([['name', '=', 'admin']])->first();
        $this->repository->save([
            'name' => 'admin',
            'display_name' => 'Администратор',
            'description' => 'Пользователь, у которого есть доступ в административную панель.',
        ], $adminRole ? $adminRole->id : 0);

        $userRole = $this->repository->searchItems([['name', '=', 'user']])->first();
        $this->repository->save([
            'name' => 'user',
            'display_name' => 'Пользователь',
            'description' => 'Пользователь, зарегистрировавшийся через сайт.',
        ], $userRole ? $userRole->id : 0);

        $socialUserRole = $this->repository->searchItems([['name', '=', 'social_user']])->first();
        $this->repository->save([
            'name' => 'social_user',
            'display_name' => 'Пользователь социальной сети',
            'description' => 'Пользователь, зарегистрировавшийся через социальную сеть.',
        ], $socialUserRole ? $socialUserRole->id : 0);
    }
}
