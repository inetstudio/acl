<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/acl',
    ],
    function () {
        Route::any('roles/data', 'DataControllerContract@getIndexData')
            ->name('back.acl.roles.data.index');

        Route::post('roles/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.acl.roles.utility.suggestions');

        Route::resource(
            'roles',
            'ResourceControllerContract',
            [
                'as' => 'back.acl',
            ]
        );
    }
);
