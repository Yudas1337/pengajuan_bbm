<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionReceiver extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'receiver_id', 'submission_id', 'quota', 'default_quota', 'status', 'validated_by', 'validated_at'];
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

    /**
     * One-to-Many relationship with SubmissionEvent Model
     *
     * @return BelongsTo
     */

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * scope a query search by verified submission
     * @param mixed $query
     *
     * @return object|null
     */

    public function scopeActive(mixed $query): object|null
    {
        return $query->where('submission_receivers.status', 1);
    }
}
