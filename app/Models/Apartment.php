<?php

namespace App\Models;

use App\Observers\ApartmentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Apartment extends Model
{
    use HasFactory;
    protected $fillable =[
        'floor',
        'number',
        'block_id',
        'condominia_id',
    ];

    public function condominia()
    {
        return $this->hasMany(Condominia::class, 'id', 'condominia_id');
    }
    public function account_client(): HasMany
    {
        return $this->HasMany(AccountClient::class, 'apartment_id', 'id');
    }
    public function block():BelongsTo
    {
        return $this->belongsTo(Block::class);
    }
}
