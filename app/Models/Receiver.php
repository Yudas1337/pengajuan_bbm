<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receiver extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    public $fillable = ['id', 'receiver_type', 'national_identity_number', 'name', 'phone_number', 'gender', 'birth_place', 'birth_date', 'profession', 'province', 'regency', 'district', 'village', 'address', 'status', 'barcode'];
    public $keyType = 'char';
    protected $table = 'receivers';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with SubmissionReceiver Model
     *
     * @return HasMany
     */

    public function submission_receivers(): HasMany
    {
        return $this->hasMany(SubmissionReceiver::class);
    }
}
