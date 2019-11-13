<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::post('password/email', 'ForgotControllerContract@sendResetLinkEmail')
            ->name('front.acl.passwords.email');

        Route::get('password/reset/{token?}', 'ResetControllerContract@showResetForm')
            ->name('front.acl.passwords.reset.get');

        Route::post('password/reset', 'ResetControllerContract@reset')
            ->name('front.acl.passwords.reset.post');
    }
);
