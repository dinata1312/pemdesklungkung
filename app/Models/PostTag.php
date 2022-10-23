<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $post_id
 * @property integer $tag_id
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Post $post
 * @property Tag $tag
 * @property User $user
 */
class PostTag extends Model
{
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tag';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'tag_id', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
