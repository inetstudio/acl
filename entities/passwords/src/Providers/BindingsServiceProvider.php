<?php

namespace InetStudio\ACL\Passwords\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var  array
     */
    public $bindings = [
        'InetStudio\ACL\Passwords\Contracts\Events\PasswordResetContract' => 'InetStudio\ACL\Passwords\Events\PasswordReset',
        'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ForgotControllerContract' => 'InetStudio\ACL\Passwords\Http\Controllers\Front\ForgotController',
        'InetStudio\ACL\Passwords\Contracts\Http\Controllers\Front\ResetControllerContract' => 'InetStudio\ACL\Passwords\Http\Controllers\Front\ResetController',
        'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ForgotRequestContract' => 'InetStudio\ACL\Passwords\Http\Requests\Front\ForgotRequest',
        'InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetRequestContract' => 'InetStudio\ACL\Passwords\Http\Requests\Front\ResetRequest',
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetLinkResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetLinkResponse',
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetFormResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetFormResponse',
        'InetStudio\ACL\Passwords\Contracts\Http\Responses\Front\ResetResponseContract' => 'InetStudio\ACL\Passwords\Http\Responses\Front\ResetResponse',
        'InetStudio\ACL\Passwords\Contracts\Listeners\SendNewCredentialsListenerContract' => 'InetStudio\ACL\Passwords\Listeners\SendNewCredentialsListener',
        'InetStudio\ACL\Passwords\Contracts\Mail\Front\NewCredentialsMailContract' => 'InetStudio\ACL\Passwords\Mail\Front\NewCredentialsMail',
        'InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetMailContract' => 'InetStudio\ACL\Passwords\Mail\Front\ResetMail',
        'InetStudio\ACL\Passwords\Contracts\Notifications\Front\NewCredentialsNotificationContract' => 'InetStudio\ACL\Passwords\Notifications\Front\NewCredentialsNotification',
        'InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetNotificationContract' => 'InetStudio\ACL\Passwords\Notifications\Front\ResetNotification',
        'InetStudio\ACL\Passwords\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Passwords\Services\Front\ItemsService',
        'InetStudio\ACL\Passwords\Contracts\Validation\Rules\CheckPasswordContract' => 'InetStudio\ACL\Passwords\Validation\Rules\CheckPassword',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
