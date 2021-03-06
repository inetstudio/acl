<?php

namespace InetStudio\ACL\Users\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class CreateFoldersCommand.
 */
class CreateFoldersCommand extends Command
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:acl:users:folders';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Create acl users folders';

    /**
     * Запуск команды.
     */
    public function handle(): void
    {
        $folders = [
            'users',
        ];

        foreach ($folders as $folder) {
            if (config('filesystems.disks.'.$folder)) {
                $path = config('filesystems.disks.'.$folder.'.root');
                $this->createDir($path);
            }
        }
    }

    /**
     * Создание директории.
     *
     * @param $path
     */
    private function createDir($path): void
    {
        if (is_dir($path)) {
            $this->info($path.' Already created.');

            return;
        }

        mkdir($path, 0777, true);
        $this->info($path.' Has been created.');
    }
}
