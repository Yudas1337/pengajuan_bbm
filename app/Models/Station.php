<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Station extends Model
{
    use HasFactory;

    public $keyType = 'char';
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = ['district_id', 'name', 'number', 'address', 'pic_name', 'pic_phone', 'type'];

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
     * many to one relationship with district
     *
     * @return BelongsTo
     */
    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
