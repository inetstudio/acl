<?php

return [

    'user_models' => [
        'users' => 'InetStudio\ACL\Users\Models\UserModel',
    ],

    'models' => [
        'role' => 'InetStudio\ACL\Roles\Models\RoleModel',
        'permission' => 'InetStudio\ACL\Permissions\Models\PermissionModel',
    ],

    'activations' => [
        'enabled' => true,
        'login_after_activate' => false,
        'mails' => [
            'subject' => 'Активация аккаунта',
        ],
    ],

    'passwords' => [
        'generate' => false,
        'mails' => [
            'subject' => 'Сброс пароля',
            'new_credentials_subject' => 'Новые данные для доступа',
        ],
    ],

    'register' => [
        'login_after_register' => false,
    ],

    'users' => [
        'mails' => [
            'credentials_subject' => 'Данные для доступа',
        ],
    ],

];
