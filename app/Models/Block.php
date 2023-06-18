<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Block extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'condominia_id'];

    public function apartments():HasMany
    {
        return $this->hasMany(Apartment::class);
    }
    public function condominia():HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
}
