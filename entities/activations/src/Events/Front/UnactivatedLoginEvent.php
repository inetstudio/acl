<?php

namespace InetStudio\ACL\Activations\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Activations\Contracts\Events\Front\UnactivatedLoginEventContract;

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
