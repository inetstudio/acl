<?php

Route::group([
    'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back/acl',
], function () {
    Route::any('users/data', 'UsersDataControllerContract@data')->name('back.acl.users.data.index');
    Route::post('users/suggestions', 'UsersUtilityControllerContract@getSuggestions')->name('back.acl.users.getSuggestions');

    Route::resource('users', 'UsersControllerContract', ['as' => 'back.acl']);
});

Route::group([
    'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
    'middleware' => ['web'],
    'prefix' => 'back',
], function () {
    Route::get('login', 'LoginControllerContract@showLoginForm')->name('back.acl.users.login.get');
    Route::post('login', 'LoginControllerContract@login')->name('back.acl.users.login.post');
});

Route::group([
    'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back',
], function () {
    Route::post('logout', 'LoginControllerContract@logout')->name('back.acl.users.logout');
});

Route::group([
    'namespace' => 'InetStudio\ACL\Users\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
], function () {
    Route::get('oauth/email', 'SocialLoginControllerContract@askEmail')->name('front.oauth.email');
    Route::post('oauth/email/approve', 'SocialLoginControllerContract@approveEmail')->name('front.oauth.email.approve');
    Route::get('oauth/{provider}', 'SocialLoginControllerContract@redirectToProvider')->name('front.oauth.login');
    Route::get('oauth/{provider}/callback', 'SocialLoginControllerContract@handleProviderCallback')->name('front.oauth.callback');

    Route::post('login', 'LoginControllerContract@loginCustom')->name('front.auth.login');
    Route::group(['middleware' => 'auth'], function () {
        Route::post('logout', 'LoginControllerContract@logout')->name('front.auth.logout');
    });

    Route::post('register', 'RegisterControllerContract@registerCustom')->name('front.acl.users.register');
});
