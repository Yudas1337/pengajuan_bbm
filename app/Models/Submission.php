<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $table = 'submissions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'group_name', 'group_leader', 'letter_number', 'date', 'district_id', 'village_id', 'station_id', 'equipment_type', 'total_equipment', 'equipment_function', 'fuel_type', 'equipment_needed', 'equipment_uptime', 'time_unit', 'formula', 'letter_file', 'excel_file', 'start_time', 'end_time', 'status', 'created_by', 'validated_by'];
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
}
