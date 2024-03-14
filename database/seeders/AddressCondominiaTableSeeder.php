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
            'road' => fake('pt_BR')->streetName(),
            'number' => fake('pt_BR')->buildingNumber(),
            'state' => fake('pt_BR')->state(),
            'district' => fake('pt_BR')->address(),
            'zip_code' => fake('pt_BR')->postcode(),
            'city' => fake('pt_BR')->city(),
        ]);
        // $getCon = DB::table('contract_condominias')->first();
        Condominia::where('name', 'Vivendas Teste')->update([
            'contract_condominias_id' => $get->id
        ]);
    }
}
