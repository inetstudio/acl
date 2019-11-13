<?php

namespace InetStudio\ACL\Roles\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:acl:roles:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup roles package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Roles seeder',
                'command' => 'inetstudio:acl:roles:seed',
            ],
        ];
    }
}
