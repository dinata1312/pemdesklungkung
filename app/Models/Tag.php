<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $term_id
 * @property integer $created_by
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Term $term
 * @property User $user
 * @property PostTag[] $postTags
 */
class Tag extends Model
{
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
    protected $fillable = ['term_id', 'created_by', 'label', 'created_at', 'updated_at', 'deleted_at'];

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
        $pTag = $this->postTags();
        return $pTag->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
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
    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }
}
