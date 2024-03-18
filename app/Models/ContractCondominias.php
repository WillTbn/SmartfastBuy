<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContractCondominias extends Model
{
    use HasFactory;
    protected $fillable =  [ 'doocument_name', 'final_date', 'initial_date'];

    public function responsible():HasOne
    {
        return $this->hasOne(Account::class, 'user_id', 'responsible_id');
    }

    public function ceo():HasOne
    {
        return $this->hasOne(Account::class, 'user_id', 'ceo_id');
    }
}
