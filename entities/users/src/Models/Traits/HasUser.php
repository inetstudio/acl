<?php

namespace InetStudio\ACL\Users\Models\Traits;

use Illuminate\Support\Facades\Config;

/**
 * Trait HasUser.
 */
trait HasUser
{
    /**
     * Отношение "один к одному" с моделью пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        $userClassName = Config::get('auth.model');

        if (is_null($userClassName)) {
            $userClassName = Config::get('auth.providers.users.model');
        }

        return $this->belongsTo(
            $userClassName,
            'id',
            'user_id'
        );
    }
}
