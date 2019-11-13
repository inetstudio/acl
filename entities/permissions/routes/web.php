<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/acl',
    ],
    function () {
        Route::any('permissions/data', 'DataControllerContract@getIndexData')
            ->name('back.acl.permissions.data.index');

        Route::post('permissions/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.acl.permissions.utility.suggestions');

        Route::resource(
            'permissions',
            'ResourceControllerContract',
            [
                'as' => 'back.acl',
            ]
        );
    }
);
