<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condominia extends Model
{
    use HasFactory;

    protected $fillable =  [ 'name'];

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
