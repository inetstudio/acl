<?php

namespace InetStudio\ACL\Users\Contracts\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;

/**
 * Interface UserModelContract.
 */
interface UserModelContract extends BaseModelContract, Auditable, Authenticatable, Authorizable, CanResetPassword
{
}
