<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Condominia;
use App\Models\ContractCondominias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondominiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominias::factory())
            ->has(Block::factory(5))
            ->create(['name' => 'Vivendas Teste']);
        Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominias::factory())
            ->has(Block::factory(2))
            ->create(['name' => 'Alfa Teste']);
        Condominia::factory()
            ->has(AddressCondominia::factory())
            ->create(['name' => 'Teste Address']);

        Account::where('user_id', 2)->update(['condominia_id'=> $cond->id]);
        Account::where('user_id', 3)->update(['condominia_id'=> $cond->id]);


    }
}
