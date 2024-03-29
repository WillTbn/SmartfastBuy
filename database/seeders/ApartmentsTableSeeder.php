<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('apartments')->insert([
            'number'=> random_int(100, 200),
            'block_id' => '1',
            'floor' => '1',
            'condominia_id'=> 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(201, 300),
            'block_id' => '2',
            'floor' => '1',
            'condominia_id'=> 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(301, 400),
            'block_id' => '3',
            'floor' => '1',
            'condominia_id'=> 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(401, 500),
            'block_id' => '4',
            'floor' => '1',
            'condominia_id'=> 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('apartments')->insert([
            'number'=> random_int(501, 600),
            'block_id' => '1',
            'floor' => '5',
            'condominia_id'=> 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
