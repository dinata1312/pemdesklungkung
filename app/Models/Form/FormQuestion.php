<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $form_id
 * @property integer $question_id
 * @property int $sequence
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property Question $question
 * @property Form $form
 * @property FormResponse[] $formResponses
 */
class FormQuestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_question';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['form_id', 'question_id', 'sequence', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formResponses()
    {
        return $this->hasMany(FormResponse::class);
    }
}
