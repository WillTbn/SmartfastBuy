<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Signature extends Model
{
    use HasFactory;
    protected $table = 'signatures';
    protected $fillable =[
        'signature_ceo',
        'signature_responsable',
        'contract_id',
    ];

    public function contractCondominias():HasOne
    {
        return $this->hasOne(ContractCondominia::class);
    }
}
