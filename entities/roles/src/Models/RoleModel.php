<?php

namespace InetStudio\ACL\Roles\Models;

use Laratrust\Models\LaratrustRole;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;

/**
 * Class RoleModel.
 */
class RoleModel extends LaratrustRole implements RoleModelContract
{
    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = strip_tags($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strip_tags($value);
    }
}
