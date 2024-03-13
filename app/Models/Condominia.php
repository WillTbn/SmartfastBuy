<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condominia extends Model
{
    use HasFactory;
    // public $table = 'condominias';
    protected $fillable =  [ 'name', 'address_condominias_id', 'contract_condominias_id'];

    public function apartments()
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
}
