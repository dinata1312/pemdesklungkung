<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $sender
 * @property integer $receiver
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property string $message
 * @property User $user
 * @property User $user
 */
class Notification extends Model
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
    protected $fillable = ['sender', 'receiver', 'type', 'created_at', 'updated_at', 'message'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver');
    }
}
