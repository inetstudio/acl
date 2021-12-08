<?php

namespace InetStudio\ACL\Users\Models;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;
use InetStudio\UploadsPackage\Uploads\Models\Traits\HasMedia;
use Laratrust\Traits\LaratrustUserTrait;
use OwenIt\Auditing\Auditable;
use InetStudio\ACL\Users\Database\Factories\UserFactory;

/**
 * Class UserModel.
 */
class UserModel extends Authenticatable implements UserModelContract
{
    use Auditable;
    use HasMedia;
    use Notifiable;
    use LaratrustUserTrait;
    use BuildQueryScopeTrait;
    use HasFactory;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'user';

    /**
     * Имя конфига.
     */
    const CONFIG_NAME = 'acl_users';

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
    protected $table = 'users';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'activated',
        'name',
        'email',
        'password',
        'api_token',
    ];

    /**
     * Атрибуты, которые должны быть скрыты.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $referrerHash = (Cookie::queued('user_referrer')) ? Cookie::queued('user_referrer')->getValue() : Cookie::get('user_referrer');

            if ($referrerHash) {
                $referrer = self::where('user_hash', $referrerHash)->first();
                $model->referrer_id = ($referrer) ? $referrer->id : null;
            }

            $hash = self::generateUserHash();

            while (self::where('user_hash', $hash)->first()) {
                $hash = self::generateUserHash();
            }

            $model->user_hash = (string) $hash;
        });

        self::$buildQueryScopeDefaults['columns'] = [
            'id', 'activated', 'name', 'email', 'remember_token',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'profile' => function ($query) {
                $query->select(['id', 'user_id', 'additional_info']);
            },
            'socialProfiles' => function ($query) {
                $query->select(['id', 'user_id', 'provider', 'provider_id', 'provider_email']);
            },
            'activation' => function ($query) {
                $query->select(['user_id', 'token', 'created_at']);
            },
        ];
    }

    /**
     * Генерируем пользовательский хэш.
     *
     * @return string
     */
    public static function generateUserHash(): string
    {
        return Str::random(config('acl_users.user_hash_length', 16));
    }

    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    /**
     * Сеттер атрибута name.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута email.
     *
     * @param $value
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута password.
     *
     * @param $value
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make(trim($value));
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     *
     * @throws BindingResolutionException
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(
            app()->make('InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetNotificationContract',
                [
                    'token' => $token,
                    'user' => $this,
                ]
            )
        );
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param $method
     * @param $parameters
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function __call($method, $parameters)
    {
        $config = implode('.', [self::CONFIG_NAME, 'relationships', $method]);

        if (Config::has($config)) {
            $data = Config::get($config);

            $model = isset($data['model']) ? [app()->make($data['model'])] : [];
            $params = isset($data['params']) ? $data['params'] : [];

            $relation = call_user_func_array([$this, $data['relationship']], array_merge($model, $params));

            if (isset($data['pivot'])) {
                $relation = $relation->withPivot($data['pivot']);
            }

            if ($data['timestamps'] ?? false) {
                $relation = $relation->withTimestamps();
            }

            return $relation;
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Get an attribute from the model.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $config = implode('.', [self::CONFIG_NAME, 'relationships', $key]);

        if (Config::has($config)) {
            return $this->getRelationValue($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Get a relationship.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getRelationValue($key)
    {
        if ($this->relationLoaded($key)) {
            return $this->relations[$key];
        }

        $config = implode('.', [self::CONFIG_NAME, 'relationships', $key]);

        if (Config::has($config)) {
            return $this->getRelationshipFromMethod($key);
        }

        return parent::getRelationValue($key);
    }

    /**
     * Отношение "один к одному" с моделью активации.
     *
     * @return HasOne
     *
     * @throws BindingResolutionException
     */
    public function activation(): HasOne
    {
        $activationModel = app()->make('InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract');

        return $this->hasOne(
            get_class($activationModel),
            'user_id',
            'id'
        );
    }

    /**
     * Отношение "один к одному" с моделью профиля.
     *
     * @return HasOne
     *
     * @throws BindingResolutionException
     */
    public function profile(): HasOne
    {
        $profileModel = app()->make('InetStudio\ACL\Profiles\Contracts\Models\ProfileModelContract');

        return $this->hasOne(
            get_class($profileModel),
            'user_id',
            'id'
        );
    }

    /**
     * Отношение "один ко многим" с моделью социального профиля.
     *
     * @return HasMany
     *
     * @throws BindingResolutionException
     */
    public function socialProfiles(): HasMany
    {
        $socialProfileModel = app()->make('InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract');

        return $this->hasMany(
            get_class($socialProfileModel),
            'user_id',
            'id'
        );
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function getMediaConfig(): array
    {
        return config('acl_users.media', []);
    }
}
