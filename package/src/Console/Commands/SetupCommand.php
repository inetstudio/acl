<?php

namespace InetStudio\ACL\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

class SetupCommand extends BaseSetupCommand
{
    protected $name = 'inetstudio:acl:setup';

    protected $description = 'Setup acl package';

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
                'description' => 'ACL permissions setup',
                'command' => 'inetstudio:acl:permissions:setup',
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
