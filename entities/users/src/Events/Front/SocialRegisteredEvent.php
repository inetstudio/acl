<?php

namespace InetStudio\ACL\Users\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract;

/**
 * Class SocialRegisteredEvent.
 */
class SocialRegisteredEvent implements SocialRegisteredEventContract
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * SocialRegisteredEvent constructor.
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }
}
