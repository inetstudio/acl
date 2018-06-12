<?php

namespace InetStudio\ACL\Permissions\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyPermissionEventContract;

/**
 * Class ModifyPermissionEvent.
 */
class ModifyPermissionEvent implements ModifyPermissionEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyPermissionEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
