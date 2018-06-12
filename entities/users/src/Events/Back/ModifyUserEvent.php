<?php

namespace InetStudio\ACL\Users\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Events\Back\ModifyUserEventContract;

/**
 * Class ModifyUserEvent.
 */
class ModifyUserEvent implements ModifyUserEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyUserEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
