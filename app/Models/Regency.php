<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    public $keyType = 'char';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $table = 'regencies';
    protected $fillable = ['id', 'province_id', 'name'];
}
