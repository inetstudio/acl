<?php

namespace InetStudio\ACL\Profiles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\AdminPanel\Models\Traits\HasJSONColumns;
use InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract;

/**
 * Class UserProfileModel.
 */
class UserProfileModel extends Model implements UserProfileModelContract
{
    use HasUser;
    use SoftDeletes;
    use HasJSONColumns;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'users_profiles';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'additional_info',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы к базовым типам.
     *
     * @var array
     */
    protected $casts = [
        'additional_info' => 'array',
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
