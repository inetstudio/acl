<?php

namespace InetStudio\ACL\Users\Notifications;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\Notification;
use InetStudio\ACL\Users\Contracts\Mail\CredentialsMailContract;
use InetStudio\ACL\Users\Contracts\Notifications\CredentialsNotificationContract;

/**
 * Class CredentialsNotification.
 */
class CredentialsNotification extends Notification implements CredentialsNotificationContract
{
    /**
     * Пароль.
     *
     * @var string
     */
    protected $password;

    /**
     * CredentialsNotification constructor.
     *
     * @param  string  $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
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
     * @return CredentialsMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): CredentialsMailContract
    {
        return app()->make(
            CredentialsMailContract::class,
            [
                'password' => $this->password,
                'user' => $notifiable,
            ]
        )->to($notifiable->email);
    }
}
