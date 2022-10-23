<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $child_of
 * @property integer $created_by
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $slug
 * @property int $sequence
 * @property Navigation $navigation
 * @property User $user
 */
class Navigation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['child_of', 'created_by', 'label', 'created_at', 'updated_at', 'deleted_at', 'slug', 'sequence'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::Where(function($q) use($query){
                $q->where('label', 'like', '%'.$query.'%')
                  ->orWhere('slug', 'like', '%'.$query.'%');
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Navigation::class, 'child_of');
    }

    public function child()
    {
        return $this->hasMany(Navigation::class, 'child_of');
    }

    public function childOrdered()
    {
        return $this->child()->orderBy('sequence')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
