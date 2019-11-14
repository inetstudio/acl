<?php

namespace InetStudio\ACL\Activations\Listeners\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Activations\Contracts\Listeners\Front\SendActivateNotificationListenerContract;
use InetStudio\ACL\Activations\Contracts\Services\Front\ItemsServiceContract as ActivationsServiceContract;

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
     * @var ActivationsServiceContract
     */
    protected $activationsService;

    /**
     * SendActivateNotificationListener constructor.
     *
     * @param  ActivationsServiceContract  $activationsService
     */
    public function __construct(ActivationsServiceContract $activationsService)
    {
        $this->activationsService = $activationsService;
    }

    /**
     * @param $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $user = $event->user;

        if ($user->activated || ! $this->shouldSend($user)) {
            return;
        }

        $token = $this->activationsService->createToken($user);

        $user->notify(
            app()->make(
                'InetStudio\ACL\Activations\Contracts\Notifications\Front\ActivateUserTokenNotificationContract',
                compact('token')
            )
        );
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
        $activation = $this->activationsService->getItemByUser($user);

        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}
