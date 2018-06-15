<?php

namespace InetStudio\ACL\Users\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
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
    use HasActivation;
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
        $config = implode( '.', ['acl.users.relationships', $method]);

        if (Config::has($config)) {
            $function = Config::get($config);

            return $function($this);
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
        $config = implode( '.', ['acl.users.relationships', $key]);

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

        $config = implode( '.', ['acl.users.relationships', $key]);

        if (Config::has($config)) {
            return $this->getRelationshipFromMethod($key);
        }

        return parent::getRelationValue($key);
    }
}
