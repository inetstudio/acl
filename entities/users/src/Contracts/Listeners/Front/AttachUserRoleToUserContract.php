<?php

namespace InetStudio\ACL\Users\Contracts\Listeners\Front;

/**
 * Interface AttachUserRoleToUserContract.
 */
interface AttachUserRoleToUserContract
{
    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void;
}
