<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property string $filename
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $extension
 * @property string $directory
 * @property string $path
 * @property boolean $private
 * @property User $user
 * @property PostImage[] $postImages
 */
class Blob extends Model
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
    protected $fillable = ['created_by', 'filename', 'created_at', 'updated_at', 'deleted_at', 'extension', 'directory', 'path', 'private'];

    public static function search($query, $directory)
    {
        return empty($query) ? static::query()
            ->where("directory",$directory)
            : static::Where("directory",$directory)
                ->Where(function($q) use($query){
                    $q->where('filename', 'like', '%'.$query.'%')
                      ->orWhere('extension', 'like', '%'.$query.'%');
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }
}
