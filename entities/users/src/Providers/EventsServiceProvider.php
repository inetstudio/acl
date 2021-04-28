<?php

namespace InetStudio\ACL\Users\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

/**
 * Class EventsServiceProvider.
 */
class EventsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $listens = [
        'Illuminate\Auth\Events\Registered' => [
            'InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract',
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract',
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\Instagram\InstagramExtendSocialite',
            'SocialiteProviders\Odnoklassniki\OdnoklassnikiExtendSocialite',
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite',
        ],
        'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract' => [
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract',
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract',
        ],
    ];

    /**
     * Загрузка сервиса.
     */
    public function boot(): void
    {
        foreach ($this->listens as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
