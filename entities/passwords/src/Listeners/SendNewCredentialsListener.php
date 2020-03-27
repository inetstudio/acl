<?php

namespace InetStudio\ACL\Passwords\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Passwords\Contracts\Listeners\SendNewCredentialsListenerContract;

/**
 * Class SendNewCredentialsListener.
 */
class SendNewCredentialsListener implements SendNewCredentialsListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $item = $event->user;
        $password = $event->password;

        $item->notify(
            app()->make(
                'InetStudio\ACL\Passwords\Contracts\Notifications\Front\NewCredentialsNotificationContract',
                compact('password')
            )
        );
    }
}
