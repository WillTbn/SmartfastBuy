<?php

namespace Database\Seeders;

use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractCondominiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resp = User::where('role_id', 3)->first();
        $master = User::where('role_id', 1)->first();
        $cond = Condominia::where('name', 'Vivendas Teste')->first();
        $get = ContractCondominia::create([
            'initial_date' => fake()->date(),
            'ceo_id' => $master->id,
            'responsible_id' => $resp->id,
            'condominia_id' => $cond->id
        ]);
        // $getCon = DB::table('contract_condominias')->first();
        Condominia::where('name', 'Vivendas Teste')->update([
            'contract_condominia_id' => $get->id
        ]);
    }
}
