<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $key
 * @property string $created_at
 * @property string $updated_at
 * @property string $content
 */
class Setting extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['key', 'created_at', 'updated_at', 'type', 'value'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'key', '%'.$query.'%')
            ->orWhere('title', 'value', '%'.$query.'%');
    }
}
