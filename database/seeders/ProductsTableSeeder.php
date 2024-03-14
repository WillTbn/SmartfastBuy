<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = DB::table('users')->first();

        DB::table('products')->insert([
            'name' => 'Império 473ml',
            'value' => 2.99,
            'sku' => 'IMPMAL473',
            'description' => 'Pilsen Puro malte',
            'category_id'=>1,
            'type'=> 'PuroMalte',
            // 'condominia_id'=> 1,
            'user_id' =>$user->id
        ]);

        DB::table('products')->insert([
            'name' => 'Brahma 473ml',
            'sku' => 'BRAPIL473',
            'value' => 2.99,
            'description' => 'cerveja pilsen',
            // 'account_id'=> 1,
            'category_id'=>1,
            'type'=> 'Pilsen',
            // 'condominia_id'=> 1,
            'user_id' =>$user->id
        ]);
        DB::table('products')->insert([
            'name' => 'Antartica 473ml',
            'sku'=>'ANTPIL473',
            'value' => 2.99,
            'description' => 'Cerveja pilsen',
            'category_id'=>1,
            'type'=> 'Pilsen',
            // 'condominia_id'=> 1,
            'user_id' =>$user->id
        ]);

        DB::table('products')->insert([
            'name' => 'Vinho Tinto Cabernet Sauvignon Reno 750ml',
            'sku' => 'VINSEC750',
            'value' => 25.90,
            'description' => 'Nacionalidade: Chilena Classificação: Seco Uva: Cabernet Sauvignon',
            // 'account_id'=> 1,
            'category_id'=>3,
            'type'=> 'Tinto',
            // 'condominia_id'=> 1,
            'user_id' =>$user->id
        ]);
        DB::table('products')->insert([
            'name' => 'Vodka Absolut Original 1L',
            'sku'=> 'VODABS1L',
            'value' => 119.90,
            'description' => '',
            // 'account_id'=> 1,
            'category_id'=>2,
            'type'=> 'Vodka',
            // 'condominia_id'=> 1,
            'user_id' =>$user->id
        ]);
    }
}
