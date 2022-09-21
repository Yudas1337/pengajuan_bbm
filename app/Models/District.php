<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    public $keyType = 'char';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $table = 'districts';
    protected $fillable = ['id', 'regency_id', 'name'];

    /**
     * One-to-Many relationship with village model
     *
     * @return HasMany
     */

    public function villages(): HasMany
    {
        return $this->hasMany(Village::class);
    }
}
