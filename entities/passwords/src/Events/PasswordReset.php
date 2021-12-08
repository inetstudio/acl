<?php

namespace InetStudio\ACL\Passwords\Events;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Passwords\Contracts\Events\PasswordResetContract;

class PasswordReset implements PasswordResetContract
{
    use SerializesModels;

    public function __construct(
        public UserModelContract $user,
        public string $password
    ) {}
}
