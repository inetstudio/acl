<?php

namespace InetStudio\ACL\Profiles\Listeners\Front;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Profiles\Contracts\Listeners\Front\CreateProfileListenerContract;

/**
 * Class CreateProfileListener.
 */
final class CreateProfileListener implements CreateProfileListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $profilesService = app()->make('InetStudio\ACL\Profiles\Contracts\Services\Front\ItemsServiceContract');

        $request = request();
        $user = $event->user;

        $profilesService->save(
            [
                'user_id' => $user->id,
                'additional_info' => $request->get('additional_info', []),
            ],
            0
        );
    }
}
