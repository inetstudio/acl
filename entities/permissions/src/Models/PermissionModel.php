<?php

namespace InetStudio\ACL\Permissions\Models;

use Laratrust\Models\LaratrustPermission;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;

/**
 * Class PermissionModel.
 */
class PermissionModel extends LaratrustPermission implements PermissionModelContract
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
