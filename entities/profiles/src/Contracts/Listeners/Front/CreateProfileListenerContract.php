<?php

namespace InetStudio\ACL\Profiles\Contracts\Listeners\Front;

/**
 * Interface CreateProfileListenerContract.
 */
interface CreateProfileListenerContract
{
    public function handle($event): void;
}
