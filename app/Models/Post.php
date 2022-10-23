<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $type_id
 * @property integer $publish_by
 * @property integer $created_by
 * @property string $title
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $content
 * @property string $setting
 * @property boolean $publish
 * @property int $view
 * @property string $reaction
 * @property string $meta
 * @property PostType $postType
 * @property User $user
 * @property User $user
 * @property Comment[] $comments
 * @property PostImage[] $postImages
 * @property PostTag[] $postTags
 */
class Post extends Model
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
    protected $fillable = [
        'type_id', 'publish_by', 'created_by','title', 'slug',
        'created_at', 'updated_at', 'deleted_at', 'content', 'setting',
        'publish', 'view', 'reaction', 'meta'];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query, $postType)
    {
        $vars = [
            "query" =>$query,
            "postType" => $postType,
        ];
        return empty($query) ? static::query()
            ->whereHas("postType",function($q) use($postType){
                $q->where('label','=', $postType);
            }) : static::with('postType')
                ->whereHas("postType",function($q) use($vars){
                    $q->where('label', $vars['postType']);
                })
                ->Where(function($q) use($vars){
                    $q->orWhere('title', 'like', '%'.$vars['query'].'%')
                    ->orWhere('content', 'like', '%'.$vars['query'].'%');
                });
    }

    // RELATION
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postType()
    {
        return $this->belongsTo(PostType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(User::class, 'publish_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }
}
