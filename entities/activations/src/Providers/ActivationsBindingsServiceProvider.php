<?php

namespace InetStudio\ACL\Activations\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ActivationsBindingsServiceProvider.
 */
class ActivationsBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\ACL\Activations\Contracts\Http\Controllers\Front\ActivationsControllerContract' => 'InetStudio\ACL\Activations\Http\Controllers\Front\ActivationsController',

        // Events
        'InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract' => 'InetStudio\ACL\Activations\Events\Front\ActivatedEvent',
        'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract' => 'InetStudio\ACL\Activations\Events\Front\SocialActivatedEvent',
        'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract' => 'InetStudio\ACL\Activations\Events\Front\UnactivatedLoginEvent',
        
        // Listeners
        'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract' => 'InetStudio\ACL\Activations\Listeners\Front\SendActivateNotificationListener',
        
        // Mail
        'InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract' => 'InetStudio\ACL\Activations\Mail\Front\ActivateUserTokenMail',
        
        // Models
        'InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract' => 'InetStudio\ACL\Activations\Models\ActivationModel',
        
        // Notifications
        'InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract' => 'InetStudio\ACL\Activations\Notifications\Front\ActivateUserTokenNotification',
        
        // Repositories
        'InetStudio\ACL\Activations\Contracts\Repositories\ActivationsRepositoryContract' => 'InetStudio\ACL\Activations\Repositories\ActivationsRepository',

        // Responses
        'InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract' => 'InetStudio\ACL\Activations\Http\Responses\Front\ActivateResponse',

        // Services
        'InetStudio\ACL\Activations\Contracts\Services\Front\ActivationsServiceContract' => 'InetStudio\ACL\Activations\Services\Front\ActivationsService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Activations\Contracts\Http\Controllers\Front\ActivationsControllerContract',
            'InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract',
            'InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract',
            'InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract',
            'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract',
            'InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract',
            'InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract',
            'InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract',
            'InetStudio\ACL\Activations\Contracts\Repositories\ActivationsRepositoryContract',
            'InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract',
            'InetStudio\ACL\Activations\Contracts\Services\Front\ActivationsServiceContract',
        ];
    }
}
