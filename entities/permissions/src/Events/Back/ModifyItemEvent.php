<?php

namespace InetStudio\ACL\Permissions\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyItemEventContract;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var PermissionModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  PermissionModelContract  $item
     */
    public function __construct(PermissionModelContract $item)
    {
        $this->item = $item;
    }
}
