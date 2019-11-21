<?php

namespace InetStudio\ACL\Passwords\Notifications\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\Notification;
use InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetMailContract;
use InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetNotificationContract;

/**
 * Class ResetNotification.
 */
class ResetNotification extends Notification implements ResetNotificationContract
{
    /**
     * Токен.
     *
     * @var string
     */
    protected $token;

    /**
     * ResetPasswordTokenNotification constructor.
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
     * @return ResetMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): ResetMailContract
    {
        return app()->make(
            ResetMailContract::class,
            [
                'token' => $this->token,
                'user' => $notifiable,
            ]
        )->to($notifiable->email);
    }
}
