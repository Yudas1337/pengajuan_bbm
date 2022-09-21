<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'receiver_type', 'national_identity_number', 'name', 'phone_number', 'gender', 'birth_place', 'birth_date', 'profession', 'province', 'regency', 'district', 'village', 'address', 'status', 'valid_from', 'valid_until', 'barcode'];
    public $keyType = 'char';
    protected $table = 'receivers';
    protected $primaryKey = 'id';
}
