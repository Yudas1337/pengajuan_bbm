<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $table = 'submissions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'group_id', 'district_id', 'village_id', 'station_id', 'receiver_type', 'letter_file', 'excel_file', 'start_time', 'end_time', 'status', 'created_by', 'validated_by_penyuluh', 'validated_by_petugas', 'validated_by_kepala_dinas', 'approval_message', 'note', 'updated_at'];
    protected $keyType = 'char';

    /**
     * One-to-Many relationship with SubmissionReceiver Model
     *
     * @return HasMany
     */

    public function submission_receivers(): HasMany
    {
        return $this->hasMany(SubmissionReceiver::class);
    }

    /**
     * One-to-Many relationship with User model
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * One-to-Many relationship with Group model
     *
     * @return BelongsTo
     */

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * One-to-Many relationship with Station model
     *
     * @return BelongsTo
     */

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    /**
     * Scope a query to search with where
     *
     * @param mixed $query
     * @param mixed $column
     * @param mixed $value
     *
     * @return object|null
     */

    public function scopeWhereLike(mixed $query, mixed $column, mixed $value): object|null
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    /**
     * scope a query search by author
     * @param mixed $query
     *
     * @return object|null
     */

    public function scopeAuthor(mixed $query): object|null
    {
        return $query->where('created_by', auth()->id());
    }

    /**
     * scope a query search by verified submission
     * @param mixed $query
     *
     * @return object|null
     */

    public function scopeVerified(mixed $query): object|null
    {
        return $query->where('status', 1);
    }
}
