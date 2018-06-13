<?php

namespace InetStudio\ACL\Activations\Models;

use Illuminate\Database\Eloquent\Model;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;

/**
 * Class ActivationModel.
 */
class ActivationModel extends Model implements ActivationModelContract
{
    use HasUser;

    const UPDATED_AT = null;

    protected $primaryKey = 'token';

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'users_activations';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы к базовым типам.
     *
     * @var array
     */
    protected $casts = [
        'token' => 'string',
    ];
}
