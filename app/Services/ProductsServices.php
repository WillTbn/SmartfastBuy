<?php

namespace App\Services;

use App\DataTransferObject\Product\ProductDTO;
use App\Models\Product;
use App\Models\ProductBarcodes;
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
            // 'products_conts' => DB::table('produt_barcodes')->with('product')->count(),
            'products_conts' => ProductBarcodes::with('product')->count(),
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
        // ->join('condominias', 'products.condominia_id', '=', 'condominias.id')
        ->select(
            'products.id',
            'products.name',
            'products.value',
            'products.sku',
            'products.image_one as preview',
            'products.description',
            // 'condominias.name as condominia_name',
            'categories.name as category_name',
            DB::raw('COUNT(product_barcodes.product_id) as total_barcodes'),
            DB::raw('SUM(product_barcodes.quantity) as total_quantity')
        )
        ->groupBy('products.id', 'products.name', 'products.value', 'products.sku', 'categories.name')
        ->get();
        return $response;
        // $products = Product::with(['condominia', 'productBarcodes'])->get();
    }
    public function getAllProductCondominia(int $condominia_id)
    {
        return
        DB::table('products')
            ->join('product_barcodes', 'products.id', '=', 'product_barcodes.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('condominias', 'product_barcodes.condominia_id', '=', 'condominias.id')
            ->select('products.id',
                'products.name',
                'products.value',
                'products.sku',
                'products.image_one as preview',
                'products.description', 'product_barcodes.id as barcode_id',
                'condominias.name as condominia_name',
                'categories.name as category_name',
                DB::raw('COUNT(product_barcodes.product_id) as total_barcodes'),
                DB::raw('SUM(product_barcodes.quantity) as total_quantity'))
            ->where('product_barcodes.condominia_id', '=', $condominia_id)
            ->groupBy(
                'products.id',
                'products.name',
                'products.value',
                'products.sku',
                'product_barcodes.id',
                'condominias.name',
                'categories.name'
            )
        ->get();


    }
    public function getOne(Product $product, $permission = false)
    {
        if(!$permission){
            $response = ProductBarcodes::
                where('condominia_id', auth()->user()->account->condominia_id)
                ->where('product_id', $product->id)
                ->with(['condominia', 'product', 'product.category', 'product.user'])
            ->get();

            return $response;
        }
        $response = ProductBarcodes::
            where('product_id', $product->id)
            ->with(['condominia', 'product', 'product.category', 'product.user'])
        ->get();
        // dd($response);

        return $response;
    }
}
