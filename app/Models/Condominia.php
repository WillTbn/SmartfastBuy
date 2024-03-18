<?php

namespace App\Models;

use App\Enums\ContractStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Condominia extends Model
{
    use HasFactory;
    // public $table = 'condominias';
    protected $fillable =  [ 'name', 'address_condominias_id', 'contract_condominias_id'];
    protected $appends = [
        'contract_status'
    ];
    public function responsable():HasOne
    {
        return $this->hasOne(Account::class, 'id', 'responsable_id');
    }
    public function contract():HasOne
    {
        return $this->hasOne(ContractCondominias::class, 'id', 'contract_condominias_id');
    }
    public function address():HasOne
    {
        return $this->hasOne(AddressCondominia::class);
    }

    public function apartments():HasMany
    {
        return  $this->hasMany(Apartment::class);
    }

    public function blocks():HasMany
    {
        return $this->hasMany(Block::class);
    }
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function productBarcode(): HasMany
    {
        return $this->hasMany(ProductBarcodes::class);
    }
    public function getContractStatusAttribute(): ContractStates
    {

        if(!$this->contract_condominias_id){
            return ContractStates::Draft;
        }
        $this->load(['contract', 'contract.responsible', 'contract.ceo']);
        if(!$this->contract->responsible && !$this->contract->ceo)
        {
            return ContractStates::Initial;
        }

        if($this->contract->responsible && !$this->contract->ceo
            || !$this->contract->responsible && $this->contract->ceo
        )
        {
            return ContractStates::Pending;
        }

        return ContractStates::Start;
    }
}
