<?php

namespace Database\Seeders;

use Database\Utility\RandomUtility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Império 473ml',
            'barcode' =>   random_int(100000000000, 1999999999999),
            'quantity' =>   random_int(20, 50),
            'value' => 2.99,
            // 'account_id'=> 1,
            'description' => 'Pilsen Puro malte',
            'category_id'=>1,
            'type'=> 'PuroMalte',
            //5661722003509 885376748848,
            'condominia_id'=> 1
        ]);
        DB::table('products')->insert([
            'name' => 'Brahma 473ml',
            'barcode' =>   random_int(100000000000, 1999999999999),
            'quantity' =>   random_int(20, 50),
            'value' => 2.99,
            'description' => '',
            // 'account_id'=> 1,
            'category_id'=>1,
            'type'=> 'Pilsen',
            'condominia_id'=> 1
        ]);
        DB::table('products')->insert([
            'name' => 'Antartica 473ml',
            'barcode' =>   random_int(100000000000, 1999999999999),
            'quantity' =>   random_int(0, 50),
            'value' => 2.99,
            'description' => '',
            // 'account_id'=> 1,
            'category_id'=>1,
            'type'=> 'Pilsen',
            'condominia_id'=> 1
        ]);

        DB::table('products')->insert([
            'name' => 'Vinho Tinto Cabernet Sauvignon Reno 750ml',
            'barcode' =>   random_int(100000000000, 1999999999999),
            'quantity' =>   random_int(0, 50),
            'value' => 25.90,
            'description' => 'Nacionalidade: Chilena Classificação: Seco Uva: Cabernet Sauvignon',
            // 'account_id'=> 1,
            'category_id'=>3,
            'type'=> 'Tinto',
            'condominia_id'=> 1
        ]);
        DB::table('products')->insert([
            'name' => 'Vodka Absolut Original 1L',
            'barcode' =>   random_int(100000000000, 1999999999999),
            'quantity' =>   random_int(0, 50),
            'value' => 119.90,
            'description' => '',
            // 'account_id'=> 1,
            'category_id'=>2,
            'type'=> 'Vodka',
            'condominia_id'=> 1
        ]);
    }
}
