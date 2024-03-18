<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductBarcodes extends Model
{
    use HasFactory;
    protected $fillable =[
        'barcode',
        'type_code',
        'product_id',
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function condominia():HasOne
    {
        return $this->hasOne(Condominia::class, 'id', 'condominia_id');
    }
}
