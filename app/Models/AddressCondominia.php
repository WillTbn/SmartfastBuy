<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AddressCondominia extends Model
{
    use HasFactory;
    protected $fillable = [
        'road', 'condominia_id', 'district', 'zip_code', 'state', 'number', 'city'
    ];

    public function condominia():HasOne
    {
        return $this->hasOne(Condominia::class);
    }

}
