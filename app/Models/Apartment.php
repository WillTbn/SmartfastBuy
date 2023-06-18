<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable =[
        'number',
        'block',
        'condominia_id',
    ];

    public function condominia()
    {
        return $this->hasMany(Condominia::class, 'id', 'condominia_id');
    }
    public function accounts(): HasMany
    {
        return $this->HasMany(Account::class);
    }
    public function block():BelongsTo
    {
        return $this->belongsTo(Block::class);
    }
}
