<?php

namespace InetStudio\ACL\Users\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Events\Back\ModifyItemEventContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var UserModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  UserModelContract  $item
     */
    public function __construct(UserModelContract $item)
    {
        $this->item = $item;
    }
}
