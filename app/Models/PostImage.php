<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $post_id
 * @property integer $created_by
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $path
 * @property Post $post
 * @property User $user
 */
class PostImage extends Model
{
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_image';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['post_id', 'image_id', 'created_by', 'label', 'created_at', 'updated_at', 'deleted_at', 'path'];

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
    public function image()
    {
        return $this->belongsTo(Blob::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
