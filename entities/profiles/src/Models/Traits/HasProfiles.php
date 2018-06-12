<?php

namespace InetStudio\ACL\Profiles\Models\Traits;

/**
 * Trait HasProfiles.
 */
trait HasProfiles
{
    /**
     * Отношение "один к одному" с моделью профиля.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function profile()
    {
        return $this->hasOne(app()->make('InetStudio\ACL\Profiles\Contracts\Models\UserProfileModelContract'), 'user_id', 'id');
    }

    /**
     * Отношение "один ко многим" с моделью социального профиля.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function socialProfiles()
    {
        return $this->hasMany(app()->make('InetStudio\ACL\Profiles\Contracts\Models\UserSocialProfileModelContract'), 'user_id', 'id');
    }
}
