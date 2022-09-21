<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionReceiver extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'receiver_id', 'submission_id', 'quota', 'status', 'validated_by', 'validated_at'];
    public $keyType = 'char';
    protected $table = 'submission_receivers';
    protected $primaryKey = 'id';


    /**
     * One-to-Many relationship with Receiver Model
     *
     * @return BelongsTo
     */

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }
}
