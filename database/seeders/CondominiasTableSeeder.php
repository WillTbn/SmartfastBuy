<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Condominia;
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
        // $resp = User::where('role_id', 3)->first();
        // $master = User::where('role_id', 1)->first();
        // // $cond = Condominia::where('name', 'Vivendas Teste')->first();
        // $get = ContractCondominias::create([
        //     'initial_date' => fake()->date(),
        //     'ceo_id' => $master->id,
        //     'responsible_id' => $resp->id
        // ]);
        // // $getCon = DB::table('contract_condominias')->first();
        // Condominia::where('name', 'Vivendas Teste')->update([
        //     'contract_condominias_id' => $get->id
        // ]);


        // $cond = DB::table('condominias')->insert([
        //     'name' => 'Vivendas Teste',
        // ]);
        // DB::table('condominias')->insert([
        //     'name' => 'Alfa Teste',
        // ]);

        $cond = Condominia::create(['name' => 'Vivendas Teste']);
        Condominia::create(['name' => 'Alfa Teste']);

        Account::where('user_id', 2)->update(['condominia_id'=> $cond->id]);
        Account::where('user_id', 3)->update(['condominia_id'=> $cond->id]);


    }
}
