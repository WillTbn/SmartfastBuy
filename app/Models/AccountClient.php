<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccountClient extends Model
{
    use HasFactory;
    protected $fillable = [
        'person',
        'telephone',
        'phone',
        'genre',
        'birthday',
        'avatar',
        'notifications',
        'apartment_id',
        'client_id',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'person',
        // 'genre' => genre::class,
    ];

    // protected $hidden = ['person'];
    public function getPersonAttribute($value):String
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
    public function client():HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    public function apartment():HasOne
    {
        return $this->hasOne(Apartment::class, 'id', 'apartment_id');
    }
}
