<?php

namespace InetStudio\ACL\Passwords\Contracts\Listeners;

/**
 * Interface SendNewCredentialsListenerContract.
 */
interface SendNewCredentialsListenerContract
{
    public function handle($event): void;
}
