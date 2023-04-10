<?php

namespace App\Models;

use App\Enums\genre;
use App\Enums\notifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'person',
        'genre',
        'avatar',
        'apartament_id',
        'user_id',
        'notifications',
        'birthday',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'person',
        'genre' => genre::class,
    ];

    public function user(): HasOne
    {
        return $this->hasOne(user::class, 'id', 'user_id');
    }
    public function apartment():HasOne
    {
        return $this->hasOne(Apartment::class, 'id', 'apartment_id');
    }
    public function condominia(): HasOneThrough{
        return $this->hasOneThrough(
            Condominia::class,
            apartment::class,
            'id',
            'id',
            'apartment_id',
            'condominia_id'
        );
    }
}
