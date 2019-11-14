<?php

namespace InetStudio\ACL\Users\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use InetStudio\ACL\Activations\Models\Traits\HasActivation;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class UserModel.
 */
class UserModel extends Authenticatable implements UserModelContract
{
    use Notifiable;
    use LaratrustUserTrait;

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
        'activated', 'name', 'email', 'password',
    ];

    /**
     * Атрибуты, которые должны быть скрыты.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $referrerHash = (Cookie::queued('user_referer')) ? Cookie::queued('user_referer')->getValue() : Cookie::get('user_referer');

            if ($referrerHash) {
                $usersRepository = app()->make('InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract');

                $referrer = $usersRepository->getModel()->where('user_hash', $referrerHash)->first();
                $model->referer_id = ($referrer) ? $referrer->id : null;
            }

            $model->user_hash = (string) Str::random();
        });
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(strip_tags($value));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = trim(strip_tags($value));
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make(trim($value));
    }

    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(app()->makeWith('InetStudio\ACL\Passwords\Contracts\Notifications\Front\ResetPasswordTokenNotificationContract', [
            'token' => $token,
            'user' => $this,
        ]));
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters) {
        $config = implode( '.', ['acl_users.relationships', $method]);

        if (Config::has($config)) {
            $data = Config::get($config);

            $model = isset($data['model']) ? [app()->make($data['model'])] : [];
            $params = isset($data['params']) ? $data['params'] : [];

            return call_user_func_array([$this, $data['relationship']], array_merge($model, $params));
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
        $config = implode( '.', ['acl_users.relationships', $key]);

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

        $config = implode( '.', ['acl_users.relationships', $key]);

        if (Config::has($config)) {
            return $this->getRelationshipFromMethod($key);
        }

        return parent::getRelationValue($key);
    }

    /**
     * Отношение "один к одному" с моделью активации.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function activation()
    {
        return $this->hasOne(app()->make('InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract'), 'user_id', 'id');
    }

    /**
     * Отношение "один к одному" с моделью профиля.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profile()
    {
        return $this->hasOne(app()->make('InetStudio\ACL\Profiles\Contracts\Models\ProfileModelContract'), 'user_id', 'id');
    }

    /**
     * Отношение "один ко многим" с моделью социального профиля.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function socialProfiles()
    {
        return $this->hasMany(app()->make('InetStudio\ACL\SocialProfiles\Contracts\Models\SocialProfileModelContract'), 'user_id', 'id');
    }
}
