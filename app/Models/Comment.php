<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $post_id
 * @property integer $created_by
 * @property integer $child_of
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $author_ip
 * @property string $content
 * @property string $type
 * @property int $rate
 * @property string $reaction
 * @property Comment $comment
 * @property Post $post
 * @property User $user
 */
class Comment extends Model
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
    protected $fillable = ['post_id', 'created_by', 'child_of', 'created_at', 'updated_at', 'deleted_at', 'author_ip', 'content', 'type', 'rate', 'reaction'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replys()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function replyOf()
    {
        return $this->belongsTo(self::class, 'child_of');
    }

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
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
