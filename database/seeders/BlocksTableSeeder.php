<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks')->insert([
            'name' => 'a1',
            'condominia_id'=> 1,
        ]);
        DB::table('blocks')->insert([
            'name' => 'a2',
            'condominia_id'=> 1,
        ]);
        DB::table('blocks')->insert([
            'name' => 'a3',
            'condominia_id'=> 1,
        ]);
        DB::table('blocks')->insert([
            'name' => 'a4',
            'condominia_id'=> 1,
        ]);
        DB::table('blocks')->insert([
            'name' => 'a5',
            'condominia_id'=> 1,
        ]);
    }
}
