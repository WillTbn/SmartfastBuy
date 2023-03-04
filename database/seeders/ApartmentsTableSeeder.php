<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apartments')->insert([
            'number'=> random_int(100, 200),
            'block' => 'a1',
            'condominium_id'=> 2,
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(201, 300),
            'block' => 'a1',
            'condominium_id'=> 2,
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(301, 400),
            'block' => 'a1',
            'condominium_id'=> 2,
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(401, 500),
            'block' => 'a1',
            'condominium_id'=> 2,
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(501, 600),
            'block' => 'a1',
            'condominium_id'=> 2,
        ]);
    }
}
