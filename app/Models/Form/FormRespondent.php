<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $form_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Form $form
 * @property FormResponse[] $formResponses
 */
class FormRespondent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_respondent';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'form_id', 'created_at', 'updated_at'];

    /**
     * Search query in multiple whereOr
     */
    public static function search($query, $formId)
    {
        return empty($query) ? static::query()
            ->where("form_id",$formId)
            : static::Where("form_id",$formId)
                ->Where(function($q) use($query){
                    $q->where('value', 'like', '%'.$query.'%');
            });
        // return empty($query) ? static::query()
        //     : static::where('value', 'like', '%'.$query.'%');
        //         // ->orWhere('marker', 'like', '%'.$query.'%');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
        return $this->hasMany(FormResponse::class, 'respondent_id');
    }
}
