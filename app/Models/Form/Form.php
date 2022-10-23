<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

/**
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $desc
 * @property boolean $closed
 * @property FormQuestion[] $formQuestions
 */
class Form extends Model
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
    protected $fillable = ['name', 'created_at', 'updated_at', 'desc', 'closed','slug','open_time','close_time'];

    /**
     * Search query in where
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formQuestions()
    {
        return $this->hasMany(FormQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formRespondents()
    {
        return $this->hasMany(FormRespondent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
