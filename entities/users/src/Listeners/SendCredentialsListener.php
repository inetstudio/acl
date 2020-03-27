<?php

namespace InetStudio\ACL\Users\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Users\Contracts\Listeners\SendCredentialsListenerContract;

/**
 * Class SendCredentialsListener.
 */
class SendCredentialsListener implements SendCredentialsListenerContract
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

        if ($password) {
            $item->notify(
                app()->make(
                    'InetStudio\ACL\Users\Contracts\Notifications\CredentialsNotificationContract',
                    compact('password')
                )
            );
        }
    }
}
