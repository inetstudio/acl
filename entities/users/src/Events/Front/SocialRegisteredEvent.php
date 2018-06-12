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
    public $object;

    /**
     * SocialRegisteredEvent constructor.
     * @param UserModelContract $object
     */
    public function __construct(UserModelContract $object)
    {
        $this->object = $object;
    }
}
