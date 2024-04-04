<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
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
    protected function casts():array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role_id' => RoleEnum::class
        ];
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'user_id', 'id');
    }
    public function role():HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
    public function isMaster()
    {
        // dd(RoleEnum::Master);
        return RoleEnum::Master == $this->role_id;
    }
    public function isSeller()
    {
        return $this->role_id === 2;
    }
    public function isResponsible()
    {
        return $this->role_id === 4;
    }
}
