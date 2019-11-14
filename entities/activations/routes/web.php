<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Activations\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::get('account/activate/{token?}', 'ItemsControllerContract@activate')->name('front.acl.activations.activate');
    }
);
