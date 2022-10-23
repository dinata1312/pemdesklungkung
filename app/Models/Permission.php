<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as PermissionSpatie;

class Permission extends PermissionSpatie
{
    /**
     * Search query in where
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }

    /**
     * MassCreate
     *
     * @param  array $arr
     * @param  int $id
     * @return void
     */
    public static function massCreate(Array $arr)
    {
        foreach ($arr['name'] as $item) {
            Permission::create([
                'name' => $item,
                'guard_name' => $arr['guard_name']
            ]);
        }
    }

}
