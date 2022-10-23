<?php

namespace App\Models;

use Spatie\Permission\Models\Role as RoleSpatie;

class Role extends RoleSpatie
{
    /**
     * Search query in where
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }

}
