<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $label
 * @property string $placeholder
 * @property string $created_at
 * @property string $updated_at
 * @property FormQuestion[] $formQuestions
 */
class Question extends Model
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
    protected $fillable = ['type', 'label', 'placeholder', 'marker', 'meta', 'required','created_at', 'updated_at'];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('label', 'like', '%'.$query.'%')
                ->orWhere('marker', 'like', '%'.$query.'%');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formQuestions()
    {
        return $this->hasMany(FormQuestion::class);
    }
}
