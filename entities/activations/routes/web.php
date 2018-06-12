<?php

Route::group([
    'namespace' => 'InetStudio\ACL\Activations\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
], function () {
    Route::get('account/activate/{token?}', 'ActivationsControllerContract@activate')->name('front.acl.activations.activate');
});
