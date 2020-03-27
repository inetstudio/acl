<?php

namespace InetStudio\ACL\Users\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Events\Front\RegisteredEventContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class RegisteredEvent.
 */
class RegisteredEvent implements RegisteredEventContract
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * SocialRegisteredEvent constructor.
     *
     * @param  UserModelContract  $user
     * @param  string  $password
     */
    public function __construct(UserModelContract $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
