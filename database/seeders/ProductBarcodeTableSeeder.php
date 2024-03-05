<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBarcodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productsIds = [
            'IMPMAL473',
            'BRAPIL473',
            'ANTPIL473',
            'VINSEC750',
            'VODABS1L'
        ];


        $products = Product::whereIn('sku', $productsIds)->pluck('id');

        foreach($products as $prod){
            DB::table('product_barcodes')->insert([
                'product_id' => $prod,
                'barcode' =>   random_int(100000000000, 1999999999999),
                'quantity' =>   random_int(0, 50),
            ]);
        }
    }
}
