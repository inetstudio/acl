<?php

namespace InetStudio\ACL\Passwords\Notifications\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\Notification;
use InetStudio\ACL\Passwords\Contracts\Mail\Front\NewCredentialsMailContract;
use InetStudio\ACL\Passwords\Contracts\Notifications\Front\NewCredentialsNotificationContract;

/**
 * Class NewCredentialsNotification.
 */
class NewCredentialsNotification extends Notification implements NewCredentialsNotificationContract
{
    /**
     * Пароль.
     *
     * @var string
     */
    protected $password;

    /**
     * ResetPasswordTokenNotification constructor.
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
     * @return NewCredentialsMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): NewCredentialsMailContract
    {
        return app()->make(
            NewCredentialsMailContract::class,
            [
                'password' => $this->password,
                'user' => $notifiable,
            ]
        )->to($notifiable->email);
    }
}
