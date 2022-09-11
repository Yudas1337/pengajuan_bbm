<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $keyType = 'char';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $table = 'districts';
    protected $fillable = ['id', 'name'];
}
