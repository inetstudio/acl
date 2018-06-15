<?php

Route::group([
    'namespace' => 'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front',
    'middleware' => ['web'],
], function () {
    Route::post('password/email', 'ForgotPasswordControllerContract@sendResetLinkEmail')->name('front.acl.passwords.email');
    Route::get('password/reset/{token?}', 'ResetPasswordControllerContract@showResetForm')->name('front.acl.passwords.reset.get');
    Route::post('password/reset', 'ResetPasswordControllerContract@reset')->name('front.acl.passwords.reset.post');
});
