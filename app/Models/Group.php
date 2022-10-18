<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'group_name', 'receiver_type', 'group_leader_id'];
    public $keyType = 'char';
    protected $table = 'groups';
    protected $primaryKey = 'id';
   
    /**
     * relation with user
     * 
     * @return BelongsTo
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'group_leader_id');
    }
}
