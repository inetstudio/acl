<?php

Route::group([
    'namespace' => 'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/acl',
], function () {
    Route::any('permissions/data', 'PermissionsDataControllerContract@data')->name('back.acl.permissions.data.index');
    Route::post('permissions/suggestions', 'PermissionsUtilityControllerContract@getSuggestions')->name('back.acl.permissions.getSuggestions');

    Route::resource('permissions', 'PermissionsControllerContract', ['as' => 'back.acl']);
});
