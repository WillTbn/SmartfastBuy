<?php

namespace App\Services;

use App\DataTransferObject\Product\ProductDTO;
use App\Models\Product;

class ProductsServices
{
    public function createProduct(ProductDTO $product, ?string $image = null): Product
    {
        $prod = new Product();
        $prod->name =$product->name;
        $prod->barcode = $product->barcode;
        $prod->quantity = $product->quantity;
        $prod->value = $product->value;
        $prod->account_id = $product->account_id;
        $prod->category_id = $product->category_id;
        $prod->type = $product->type;
        $prod->description = $product->description;
        if($image){
            $prod->image_one = $image;
        }
        $prod->save();

        return $prod;
    }
    public function updateProduct(ProductDTO $product, int $id, ?string $image = null): Product
    {
        $prod = Product::where('id', $id)->first();
        $prod->name =$product->name;
        $prod->barcode = $product->barcode;
        $prod->quantity = $product->quantity;
        $prod->value = $product->value;
        $prod->account_id = $product->account_id;
        $prod->category_id = $product->category_id;
        $prod->type = $product->type;
        $prod->description = $product->description;
        if($image){
            $prod->image_one = $image;
        }
        $prod->save();

        return $prod;
    }
}
