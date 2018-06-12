<?php

namespace InetStudio\ACL\Roles\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Roles\Contracts\Events\Back\ModifyRoleEventContract;

/**
 * Class ModifyRoleEvent.
 */
class ModifyRoleEvent implements ModifyRoleEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyRoleEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
