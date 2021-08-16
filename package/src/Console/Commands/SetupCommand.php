<?php

namespace InetStudio\ACL\Console\Commands;

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
    protected $name = 'inetstudio:acl:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup acl package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Laratrust migrations',
                'command' => 'laratrust:migration',
            ],
            [
                'type' => 'cli',
                'description' => 'dump-autoload',
                'command' => ['composer', 'du'],
            ],
            [
                'type' => 'artisan',
                'description' => 'Migration',
                'command' => 'migrate',
            ],
            [
                'type' => 'artisan',
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\ACL\Providers\ServiceProvider',
                    '--tag' => 'config',
                ],
            ],
            [
                'type' => 'artisan',
                'description' => 'ACL activations setup',
                'command' => 'inetstudio:acl:activations:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'ACL profiles setup',
                'command' => 'inetstudio:acl:profiles:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'ACL social profiles setup',
                'command' => 'inetstudio:acl:social-profiles:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'ACL roles setup',
                'command' => 'inetstudio:acl:roles:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'ACL users setup',
                'command' => 'inetstudio:acl:users:setup',
            ],
        ];
    }
}
