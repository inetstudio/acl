<?php

namespace InetStudio\ACL\Activations\Notifications\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\Notification;
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
    protected $token;

    /**
     * ActivateUserTokenNotification constructor.
     *
     * @param  string  $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): ActivateUserTokenMailContract
    {
        return app()->make(
            'InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract',
            [
                'token' => $this->token,
            ]
        );
    }
}
