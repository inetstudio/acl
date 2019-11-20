<?php

namespace InetStudio\ACL\Activations\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class ActivatedEvent.
 */
class ActivatedEvent implements ActivatedEventContract
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var UserModelContract
     */
    public $user;

    /**
     * ActivatedEvent constructor.
     *
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }
}
