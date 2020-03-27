<?php

namespace InetStudio\ACL\Passwords\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Auth\Authenticatable;
use InetStudio\ACL\Passwords\Contracts\Events\PasswordResetContract;

/**
 * Class PasswordReset.
 */
class PasswordReset implements PasswordResetContract
{
    use SerializesModels;

    /**
     * The user.
     *
     * @var Authenticatable
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * PasswordReset constructor.
     *
     * @param  Authenticatable $user
     * @param  string  $password
     */
    public function __construct(Authenticatable $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
