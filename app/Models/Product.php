<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'sku',
        'value', 'type', 'condominia_id', 'category_id',
        'description', 'image_one', 'image_two', 'user_id'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    // public function account(): HasMany
    // {
    //     return $this->hasMany(Account::class, 'user_id', 'account_id');
    // }
    public function condominia(): HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
    public function productBarcode(): HasMany
    {
        return $this->hasMany(ProductBarcodes::class);
    }
}
