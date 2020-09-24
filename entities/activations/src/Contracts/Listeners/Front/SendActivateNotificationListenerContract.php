<?php

namespace InetStudio\ACL\Activations\Contracts\Listeners\Front;

/**
 * Interface SendActivateNotificationListenerContract.
 */
interface SendActivateNotificationListenerContract
{
    public function handle($event): void;
}
