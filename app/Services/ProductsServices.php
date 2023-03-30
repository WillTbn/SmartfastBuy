<?php

namespace App\Services;

use App\DataTransferObject\Product\ProductDTO;
use App\Models\Product;

class ProductsServices
{
    public function createProduct(ProductDTO $product): Product
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

        return $prod;
    }
}
