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
    protected $fillable =  [ 'name', 'address_condominias_id', 'contract_condominias_id', 'responsible_id'];
    protected $appends = [
        'contract_status'
    ];
    public function responsable():HasOne
    {
        return $this->hasOne(Account::class, 'id', 'responsible_id');
    }
    public function contractCondominia():HasOne
    {
        return $this->hasOne(ContractCondominias::class);
    }
    public function addressCondominia():HasOne
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

        $this->load([
            'responsable', 'contractCondominia', 'contractCondominia.responsible',
            'contractCondominia.ceo', 'contractCondominia.signature',
        ]);
        if(!$this->contractCondominia){
            return ContractStates::Draft;
        }
        if(!$this->contractCondominia->ceo){
            return ContractStates::Initial;
        }
        if($this->contractCondominia->signature && !$this->contractCondominia->signature->signature_responsible){
            /// AQUI TEM QUE NOTIFICAR SOMENTE O USUÀRIO responsible
            // SOBRE A NECESSIDADE DE DAR ACEITAR NO CONTRATO
            return ContractStates::Pending;
        }
        return ContractStates::Start;
    }
}
