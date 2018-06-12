<?php

namespace InetStudio\ACL\Users\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
