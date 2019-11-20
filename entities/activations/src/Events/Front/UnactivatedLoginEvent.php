<?php

namespace InetStudio\ACL\Activations\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class UnactivatedLoginEvent.
 */
class UnactivatedLoginEvent implements UnactivatedLoginEventContract
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * UnactivatedLoginEvent constructor.
     *
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }
}
