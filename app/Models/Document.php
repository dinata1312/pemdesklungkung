<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\Form;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $form_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Form $form
 */
class Document extends Model
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
    protected $fillable = ['created_by', 'form_id', 'title', 'content', 'created_at', 'updated_at'];

    /**
     * Search query in where
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%'.$query.'%');
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
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
