<?php

namespace InetStudio\ACL\Activations\Models;

use Illuminate\Database\Eloquent\Model;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class ActivationModel.
 */
class ActivationModel extends Model implements ActivationModelContract
{
    use BuildQueryScopeTrait;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'activation';

    /**
     * Не использовать время обновления.
     */
    const UPDATED_AT = null;

    /**
     * Первичный ключ.
     *
     * @var string
     */
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

    /**
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'user_id',
            'token',
            'created_at',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'user' => function ($query) {
                $query->select(['id', 'name', 'email']);
            },
        ];
    }

    /**
     * Сеттер атрибута user_id.
     *
     * @param $value
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута token.
     *
     * @param $value
     */
    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = trim(strip_tags($value));
    }

    /**
     * Геттер атрибута type.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    use HasUser;
}
