<?php

namespace InetStudio\ACL\Activations\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Activations\Contracts\Events\Front\SocialActivatedEventContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class SocialActivatedEvent.
 */
class SocialActivatedEvent implements SocialActivatedEventContract
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * SocialActivatedEvent constructor.
     *
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }
}
