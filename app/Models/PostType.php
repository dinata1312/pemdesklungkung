<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $slug
 * @property integer $created_by
 * @property Post[] $posts
 */
class PostType extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_type';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['label', 'created_at', 'updated_at', 'deleted_at', 'slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'type_id');
    }
}
