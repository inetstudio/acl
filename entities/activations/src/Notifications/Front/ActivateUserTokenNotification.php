<?php

namespace InetStudio\ACL\Activations\Notifications\Front;

use Illuminate\Notifications\Notification;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract;
use InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract;

/**
 * Class ActivateUserTokenNotification.
 */
class ActivateUserTokenNotification extends Notification implements ActivateUserTokenNotificationContract
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
     * ActivateUserTokenNotification constructor.
     *
     * @param string $token
     * @param UserModelContract $user
     */
    public function __construct(string $token, UserModelContract $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
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
     * @return ActivateUserTokenMailContract
     */
    public function toMail($notifiable): ActivateUserTokenMailContract
    {
        return app()->makeWith('InetStudio\ACL\Activations\Contracts\Mail\ActivateUserTokenMailContract', [
            'token' => $this->token,
        ])->to($this->user->email);
    }
}
