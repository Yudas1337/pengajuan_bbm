<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionHistory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'submission_histories';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'submission_receiver_id', 'quota_cost', 'user_id'];
    protected $keyType = 'char';

    /**
     * One-to-Many relationship with Submission Model
     *
     * @return BelongsTo
     */

    public function submission_receiver(): BelongsTo
    {
        return $this->belongsTo(SubmissionReceiver::class, 'submission_receiver_id');
    }

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
