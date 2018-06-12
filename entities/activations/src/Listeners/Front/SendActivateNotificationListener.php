<?php

namespace InetStudio\ACL\Activations\Listeners\Front;

use InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract;

/**
 * Class SendActivateNotificationListener.
 */
class SendActivateNotificationListener implements SendActivateNotificationListenerContract
{
    /**
     * Через сколько часов можно посылать повторную ссылку для активации.
     *
     * @var int
     */
    protected $resendAfter = 24;

    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * SendActivateNotificationListener constructor.
     */
    public function __construct()
    {
        $this->services['activations'] = app()->make('InetStudio\ACL\Activations\Contracts\Services\Front\ActivationsServiceContract');
    }

    /**
     * Handle the event.
     *
     * @param $event
     *
     * @return void
     */
    public function handle($event): void
    {
        $user = $event->user;

        if ($user->activated || ! $this->shouldSend($user)) {
            return;
        }

        $token = $this->services['activations']->createActivation($user);

        $user->notify(app()->makeWith('InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract', [
            'token' => $token,
            'user' => $user,
        ]));
    }

    /**
     * Проверяем, нужно ли отправлять письмо.
     *
     * @param $user
     *
     * @return bool
     */
    private function shouldSend($user): bool
    {
        $activation = $this->services['activations']->getActivation($user);

        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}
