<?php

namespace Database\Seeders;

use App\Models\AddressCondominia;
use App\Models\Condominia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressCondominiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $get = AddressCondominia::create([
            'road' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'state' => fake()->state(),
            'district' => fake()->address(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
        ]);
        // $getCon = DB::table('contract_condominias')->first();
        Condominia::where('name', 'Vivendas Teste')->update([
            'address_condominias_id' => $get->id
        ]);
    }
}
