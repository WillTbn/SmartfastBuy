<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContractCondominia extends Model
{
    use HasFactory;
    protected $fillable =  [ 'document_name', 'final_date', 'initial_date', 'ceo_id', 'responsible_id'];

    public function responsible():HasOne
    {
        return $this->hasOne(Account::class, 'user_id', 'responsible_id');
    }

    public function ceo():HasOne
    {
        return $this->hasOne(Account::class, 'user_id', 'ceo_id');
    }
    public function condominia():HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
}
