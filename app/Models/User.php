<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    public $keyType = 'char';
    public $primaryKey = 'id';
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'station_id',
        'name',
        'username',
        'email',
        'password',
        'district_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * One-to-Many relationship with Station Model
     *
     * @return BelongsTo
     */

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    /**
     * One-to-Many relationship with District Model
     *
     * @return BelongsTo
     */

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * One-to-One relationship with Group Model
     *
     * @return HasOne
     */

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'group_leader_id');
    }
}
