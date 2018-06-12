<?php

namespace InetStudio\ACL\Users\Notifications;

use Illuminate\Notifications\Notification;
use InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Notifications\NewUserNotificationContract;

/**
 * Class NewUserNotification.
 */
class NewUserNotification extends Notification implements NewUserNotificationContract
{
    protected $user;

    /**
     * NewCommentNotification constructor.
     *
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail', 'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     * @return NewUserMailContract
     */
    public function toMail($notifiable): NewUserMailContract
    {
        return app()->makeWith('InetStudio\ACL\Users\Contracts\Models\UserModelContract', [
            'user' => $this->user,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'user_id' => $this->user->id,
        ];
    }
}
