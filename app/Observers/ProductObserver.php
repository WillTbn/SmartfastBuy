<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        dd('From created Oberser', $product);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if($product->isDirty('image_one')){
            // TIRA ISSO PARA OUTRA Fazer uma abstração CLASS or HELPER
            $str = explode('products', $product->getOriginal('image_one'));
            $nameFile = end($str);
            // TIRA ISSO PARA OUTRA CLASS or HELPER
            Storage::disk('public')->delete('/products'.$nameFile);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        dd('From restored Oberser', $product);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
