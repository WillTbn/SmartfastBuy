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
            'products_conts' => DB::table('produt_barcodes')->with('product')->count(),
            'count' => DB::table('products')->count(),
            'icons' => 'fa-solid fa-shop'
        ];

        return $result;
    }
    public function getAllProduct()
    {

        $response =
        DB::table('products')
        ->join('product_barcodes', 'products.id', '=', 'product_barcodes.product_id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('condominias', 'products.condominia_id', '=', 'condominias.id')
        ->select(
            'products.id',
            'products.name',
            'products.value',
            'products.sku',
            'products.image_one as preview',
            'products.description',
            'condominias.name as condominia_name',
            'categories.name as category_name',
            DB::raw('COUNT(product_barcodes.product_id) as total_barcodes'),
            DB::raw('SUM(product_barcodes.quantity) as total_quantity')
        )
        ->groupBy('products.id', 'products.name', 'products.value', 'products.sku', 'condominias.name', 'categories.name')
        ->get();
        // $products = Product::with(['condominia', 'productBarcodes'])->get();

        return $response;
    }
    public function getOne(Product $product)
    {
        // DB::table('products')->where('id','=', $product->id)->get();
        $response = $product->where('id', $product->id)->with(['condominia', 'category', 'productBarcodes','user'])->first();

        return $response;
    }
}
