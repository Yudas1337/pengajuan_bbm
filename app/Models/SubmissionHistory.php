<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionHistory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'submission_histories';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'submission_receiver_id', 'quota_cost', 'user_id'];
    protected $keyType = 'char';
}
