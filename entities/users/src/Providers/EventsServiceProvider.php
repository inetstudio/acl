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
            'SocialiteProviders\VKontakte\VKontakteExtendSocialite',
            'JhaoDa\SocialiteProviders\Odnoklassniki\OdnoklassnikiExtendSocialite',
            'SocialiteProviders\Instagram\InstagramExtendSocialite',
        ],
        'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract' => [
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract',
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract',
        ],
    ];

    /**
     * Загрузка сервиса.
     *
     * @return void
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
