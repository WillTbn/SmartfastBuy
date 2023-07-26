<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'person',
        'genre',
        'avatar',
        'apartament_id',
        'user_id',
        'notifications',
        'birthday',
        'phone',
        'telephone'
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

    // protected $hidden = ['person'];
    public function getPersonAttribute($value)
    {
        // Verifica se o valor do CPF existe e tem pelo menos 11 dígitos
        if ($value && strlen($value) >= 11) {
            // Obtém os quatro últimos dígitos do CPF
            $lastFourDigits = substr($value, -4);

            // Formata o CPF com asteriscos, mantendo apenas os quatro últimos dígitos
            return '***.***.***-' . $lastFourDigits;
        }

        return $value;
    }

    public function user(): HasOne
    {
        return $this->hasOne(user::class, 'id', 'user_id');
    }
    // public function apartment():HasOne
    // {
    //     return $this->hasOne(Apartment::class, 'id', 'apartment_id');
    // }
    // public function condominia(): HasOneThrough{
    //     return $this->hasOneThrough(
    //         Condominia::class,
    //         apartment::class,
    //         'id',
    //         'id',
    //         'apartment_id',
    //         'condominia_id'
    //     );
    // }
}
