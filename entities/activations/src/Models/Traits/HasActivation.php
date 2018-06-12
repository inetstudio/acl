<?php

namespace InetStudio\ACL\Activations\Models\Traits;

/**
 * Trait HasActivation.
 */
trait HasActivation
{
    /**
     * Отношение "один к одному" с моделью активации.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function activation()
    {
        return $this->hasOne(app()->make('InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract'), 'user_id', 'id');
    }
}
