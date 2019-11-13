<?php

namespace InetStudio\ACL\Roles\Console\Commands;

use Illuminate\Console\Command;
use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;

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
     * @var ItemsServiceContract
     */
    protected $rolesService;

    /**
     * CreateRolesCommand constructor.
     *
     * @param  ItemsServiceContract  $rolesService
     */
    public function __construct(ItemsServiceContract $rolesService)
    {
        parent::__construct();

        $this->rolesService = $rolesService;
    }

    /**
     * Запуск команды.
     */
    public function handle(): void
    {
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
