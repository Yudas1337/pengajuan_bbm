<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    public $keyType = 'char';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $table = 'villages';
    protected $fillable = ['id', 'district_id', 'name'];
}
