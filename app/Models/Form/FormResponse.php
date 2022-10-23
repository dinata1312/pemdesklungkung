<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $form_question_id
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property FormQuestion $formQuestion
 * @property User $user
 */
class FormResponse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_response';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['respondent_id', 'form_question_id', 'value', 'created_at', 'updated_at'];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('user_id', 'like', '%'.$query.'%')
                ->orWhere('form_question_id', 'like', '%'.$query.'%');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formQuestion()
    {
        return $this->belongsTo(FormQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formRespondent()
    {
        return $this->belongsTo(FormRespondent::class);
    }
}
