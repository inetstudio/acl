<?php

namespace InetStudio\ACL\Activations\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        'InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract' => 'InetStudio\ACL\Activations\Events\Front\ActivatedEvent',
        'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract' => 'InetStudio\ACL\Activations\Events\Front\SocialActivatedEvent',
        'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract' => 'InetStudio\ACL\Activations\Events\Front\UnactivatedLoginEvent',
        'InetStudio\ACL\Activations\Contracts\Http\Controllers\Front\ItemsControllerContract' => 'InetStudio\ACL\Activations\Http\Controllers\Front\ItemsController',
        'InetStudio\ACL\Activations\Contracts\Http\Middleware\Front\CheckActivationContract' => 'InetStudio\ACL\Activations\Http\Middleware\Front\CheckActivation',
        'InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract' => 'InetStudio\ACL\Activations\Http\Responses\Front\ActivateResponse',
        'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract' => 'InetStudio\ACL\Activations\Listeners\Front\SendActivateNotificationListener',
        'InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract' => 'InetStudio\ACL\Activations\Mail\Front\ActivateUserTokenMail',
        'InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract' => 'InetStudio\ACL\Activations\Models\ActivationModel',
        'InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract' => 'InetStudio\ACL\Activations\Notifications\Front\ActivateUserTokenNotification',
        'InetStudio\ACL\Activations\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Activations\Services\Front\ItemsService',
    ];

    public function provides()
    {
        return array_keys($this->bindings);
    }
}
