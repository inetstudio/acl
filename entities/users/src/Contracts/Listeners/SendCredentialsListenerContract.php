<?php

namespace InetStudio\ACL\Users\Contracts\Listeners;

/**
 * Interface SendCredentialsListenerContract.
 */
interface SendCredentialsListenerContract
{
    public function handle($event): void;
}
