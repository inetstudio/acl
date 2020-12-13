<?php

namespace InetStudio\ACL\Users\Contracts\Listeners\Front;

/**
 * Interface AttachSocialRoleToUserContract.
 */
interface AttachSocialRoleToUserContract
{
    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void;
}
