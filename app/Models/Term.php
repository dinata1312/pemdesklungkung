<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $created_by
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User $user
 * @property Tag[] $tags
 */
class Term extends Model
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
    protected $fillable = ['created_by', 'label', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('label', 'like', '%'.$query.'%');
    }

    public function countPost()
    {
        $tags = $this->tags();
        $amount = 0;
        foreach ($tags->get() as $item) {
            $amount = $amount + $item->countPost();
        }
        return $amount;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
