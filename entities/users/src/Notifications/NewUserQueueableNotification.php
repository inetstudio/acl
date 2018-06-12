<?php

namespace InetStudio\ACL\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\ACL\Users\Contracts\Notifications\NewUserQueueableNotificationContract;

/**
 * Class NewUserQueueableNotification.
 */
class NewUserQueueableNotification extends NewUserNotification implements ShouldQueue, NewUserQueueableNotificationContract
{
    use Queueable;
}
