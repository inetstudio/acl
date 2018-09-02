<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальные диски для хранения лого сайтов
     */

    'users' => [
        'driver' => 'local',
        'root' => storage_path('app/public/users'),
        'url' => env('APP_URL').'/storage/users',
        'visibility' => 'public',
    ],

];
