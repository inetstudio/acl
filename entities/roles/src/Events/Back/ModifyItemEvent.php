<?php

namespace InetStudio\ACL\Roles\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Roles\Contracts\Events\Back\ModifyItemEventContract;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var RoleModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  RoleModelContract  $item
     */
    public function __construct(RoleModelContract $item)
    {
        $this->item = $item;
    }
}
