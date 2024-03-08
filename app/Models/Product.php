<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'sku',
        'value', 'type', 'condominia_id', 'category_id',
        'description', 'image_one', 'image_two', 'image_three', 'user_id'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function getImageOneAttribute($value)
    {
        return $value != 'default-illustrative.png' ? asset('storage/products/'.$value) : asset($value);
    }
    public function getImageTwoAttribute($value)
    {
        return $value != 'default-illustrative.png' ? asset('storage/products/'.$value) : asset($value);

    }
    public function getImageThreeAttribute($value)
    {

        return $value != 'default-illustrative.png' ? asset('storage/products/'.$value) : asset($value);
    }
    // public function account(): HasMany
    // {
    //     return $this->hasMany(Account::class, 'user_id', 'account_id');
    // }
    public function condominia(): HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
    public function productBarcodes(): HasMany
    {
        return $this->hasMany(ProductBarcodes::class);
    }
    public function user():HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
