<?php

namespace InetStudio\ACL\Users\Contracts\Models;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Interface UserModelContract.
 */
interface UserModelContract extends BaseModelContract, Auditable, Authenticatable, Authorizable, CanResetPassword, HasMedia
{
}
