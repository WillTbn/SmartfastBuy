<?php

namespace App\Services;

use App\DataTransferObject\Product\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        $prod->condominia_id = $product->condominia_id;
        if($image){
            $prod->image_one = $image;
        }
        $prod->saveOrFail();

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
        $prod->condominia_id = $product->condominia_id;
        if($image){
            $prod->image_one = $image;
        }
        $prod->saveOrFail();

        return $prod;
    }
    public function countProducts(): array
    {
        $result = [
            'name'=> 'produtos',
            'count' => DB::table('products')->count(),
            'icons' => 'fa-solid fa-shop'
        ];
        return $result;
    }
    public function getAllProduct()
    {
        $products = Product::with(['condominia'])->get();

        return $products;
    }
}
