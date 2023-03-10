<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Cervejas',
            'updated_at' => now(),
            'created_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Destilados',
            'updated_at' => now(),
            'created_at' => now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Vinhos',
            'updated_at' => now(),
            'created_at' => now()
        ]);
    }
}
