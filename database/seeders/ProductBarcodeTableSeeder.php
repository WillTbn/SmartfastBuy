<?php

namespace Database\Seeders;

use App\Models\Condominia;
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

        // $productsIds = [
        //     'IMPMAL473',
        //     'BRAPIL473',
        //     'ANTPIL473',
        //     'VINSEC750',
        //     'VODABS1L'
        // ];


        // $products = Product::whereIn('sku', $productsIds)->pluck('id');
        $products = Product::all()->pluck('id');
        $condominia = Condominia::all()->pluck('id');
        foreach($condominia as $cond){
            foreach($products as $prod){
                DB::table('product_barcodes')->insert([
                    'condominia_id' => $cond,
                    'product_id' => $prod,
                    'barcode' =>   fake()->ean13(),
                    'quantity' =>   random_int(0, 50),
                ]);
            }
        }
    }
}
