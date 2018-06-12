<?php

namespace InetStudio\ACL\Passwords\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class PasswordsBindingsServiceProvider.
 */
class PasswordsBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotPasswordControllerContract' => 'InetStudio\ACL\Passwords\Http\Controllers\Front\ForgotPasswordController',
        'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ResetPasswordControllerContract' => 'InetStudio\ACL\Passwords\Http\Controllers\Front\ResetPasswordController',

        // Mail
        'InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetPasswordTokenMailContract' => 'InetStudio\ACL\Passwords\Mail\Front\ResetPasswordTokenMail',

        // Notifications
        'InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetPasswordTokenNotificationContract' => 'InetStudio\ACL\Passwords\Notifications\Front\ResetPasswordTokenNotification',

        // Requests
        'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotPasswordRequestContract' => 'InetStudio\ACL\Passwords\Http\Requests\Front\ForgotPasswordRequest',
        'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetPasswordRequestContract' => 'InetStudio\ACL\Passwords\Http\Requests\Front\ResetPasswordRequest',

        // Responses
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetLinkResponse',
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordFormResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetPasswordFormResponse',
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetPasswordResponse',

        // Services
        'InetStudio\ACL\Passwords\Contracts\Services\Front\PasswordsServiceContract' => 'InetStudio\ACL\Passwords\Services\Front\PasswordsService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotPasswordControllerContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ResetPasswordControllerContract',
            'InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetPasswordTokenMailContract',
            'InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetPasswordTokenNotificationContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotPasswordRequestContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetPasswordRequestContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordFormResponseContract',
            'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetPasswordResponseContract',
            'InetStudio\ACL\Passwords\Contracts\Services\Front\PasswordsServiceContract',
        ];
    }
}
