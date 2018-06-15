<?php

namespace InetStudio\ACL\Profiles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract;

/**
 * Class UserSocialProfileModel.
 */
class UserSocialProfileModel extends Model implements UserSocialProfileModelContract
{
    use HasUser;
    use SoftDeletes;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'users_socials_profiles';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_id', 'provider_email',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
