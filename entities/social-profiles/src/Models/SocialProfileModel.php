<?php

namespace InetStudio\ACL\SocialProfiles\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;
use InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract;

/**
 * Class SocialProfileModel.
 */
class SocialProfileModel extends Model implements SocialProfileModelContract
{
    use Auditable;
    use SoftDeletes;
    use BuildQueryScopeTrait;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'user_social_profile';

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;

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
        'user_id',
        'provider',
        'provider_id',
        'provider_email',
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

    /**
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id',
            'user_id',
            'provider',
            'provider_id',
            'provider_email',
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
     * Сеттер атрибута provider.
     *
     * @param $value
     */
    public function setProviderAttribute($value): void
    {
        $this->attributes['provider'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута provider_id.
     *
     * @param $value
     */
    public function setProviderIdAttribute($value): void
    {
        $this->attributes['provider_id'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута provider_email.
     *
     * @param $value
     */
    public function setProviderEmailAttribute($value): void
    {
        $this->attributes['provider_email'] = trim(strip_tags($value));
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
