<?php

Route::group([
    'namespace' => 'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/acl',
], function () {
    Route::any('roles/data', 'RolesDataControllerContract@data')->name('back.acl.roles.data.index');
    Route::post('roles/suggestions', 'RolesUtilityControllerContract@getSuggestions')->name('back.acl.roles.getSuggestions');

    Route::resource('roles', 'RolesControllerContract', ['as' => 'back.acl']);
});
