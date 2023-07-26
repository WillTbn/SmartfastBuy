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
        'name', 'barcode', 'quantity',
        'value', 'account_id','category_id', 'type',
        'image_one', 'image_two', 'image_three',
        'description', 'deleted_at'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function account(): HasMany
    {
        return $this->hasMany(Account::class, 'user_id', 'account_id');
    }
    public function condominia(): HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
}
