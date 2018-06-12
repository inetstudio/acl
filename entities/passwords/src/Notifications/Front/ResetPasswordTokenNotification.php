<?php

namespace InetStudio\ACL\Passwords\Notifications\Front;

use Illuminate\Notifications\Notification;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetPasswordTokenMailContract;
use InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetPasswordTokenNotificationContract;

/**
 * Class ResetPasswordTokenNotification.
 */
class ResetPasswordTokenNotification extends Notification implements ResetPasswordTokenNotificationContract
{
    /**
     * Токен.
     *
     * @var string
     */
    public $token;

    /**
     * Пользователь.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * ResetPasswordTokenNotification constructor.
     *
     * @param $token
     * @param UserModelContract $user
     */
    public function __construct($token, UserModelContract $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return ResetPasswordTokenMailContract
     */
    public function toMail($notifiable): ResetPasswordTokenMailContract
    {
        return app()->makeWith('InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetPasswordTokenMailContract', [
            'token' => $this->token,
        ])->to($this->user->email);
    }
}
