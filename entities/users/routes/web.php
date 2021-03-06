<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/acl',
    ],
    function () {
        Route::any('users/data/index', 'DataControllerContract@getIndexData')
            ->name('back.acl.users.data.index');

        Route::post('users/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.acl.users.utility.suggestions');

        Route::get('users/export', 'ExportControllerContract@exportItems')
            ->name('back.acl.users.export');

        Route::resource(
            'users',
            'ResourceControllerContract',
            [
                'as' => 'back.acl',
            ]
        );
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
        'middleware' => ['web'],
        'prefix' => 'back',
    ],
    function () {
        Route::get('login', 'LoginControllerContract@showLoginForm')->name('back.acl.users.login.get');
        Route::post('login', 'LoginControllerContract@login')->name('back.acl.users.login.post');
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back',
    ],
    function () {
        Route::post('logout', 'LoginControllerContract@logout')->name('back.acl.users.logout');
    }
);

Route::group(
    [
        'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Front',
        'middleware' => ['web'],
    ],
    function () {
        Route::get('oauth/email', 'SocialLoginControllerContract@askEmail')->name('front.acl.users.oauth.email');
        Route::post('oauth/email/approve', 'SocialLoginControllerContract@approveEmail')->name('front.acl.users.oauth.email.approve');
        Route::get('oauth/{provider}', 'SocialLoginControllerContract@redirectToProvider')->name('front.acl.users.oauth.login');
        Route::get('oauth/{provider}/callback', 'SocialLoginControllerContract@handleProviderCallback')->name('front.acl.users.oauth.callback');

        Route::post('login', 'LoginControllerContract@login')->name('front.acl.users.login');
        Route::group(['middleware' => 'auth'], function () {
            Route::post('logout', 'LoginControllerContract@logout')->name('front.acl.users.logout');
        });

        Route::post('register', 'RegisterControllerContract@register')->name('front.acl.users.register');
    }
);
