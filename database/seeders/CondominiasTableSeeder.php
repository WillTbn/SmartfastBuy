<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CondominiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMaster = User::where('role_id', RoleEnum::Master)->first();
        $userResponsible =  User::where('role_id', RoleEnum::Responsible)->first();
        // $all = User::all();
        // dd($all);
        $signatureMaster = Hash::make($userMaster->account->person.$userMaster->account->birthday);
        $signatureResponsible = Hash::make($userResponsible->account->person.$userResponsible->account->birthday);
        // STATUS START
        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(
                ContractCondominia::factory(1, ['ceo_id' => $userMaster->account->id, 'responsible_id' => $userResponsible->account->id])
                ->has(Signature::factory(1, ['signature_ceo' => $signatureMaster, 'signature_responsible' => $signatureResponsible]))
            )
            ->has(Block::factory(5))
        ->create(['name' => 'Vivendas Teste']);
        Account::where('user_id', 2)->update(['condominia_id'=> $cond->id]);
        Account::where('user_id', 3)->update(['condominia_id'=> $cond->id]);

        $ceo = User::factory()->has(Account::factory())->create();
        $signature = Hash::make($ceo->account->person.$ceo->account->birthday);
        // STATUS PENDING
        Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominia::factory(
                1,
                ['ceo_id' => $ceo->account->id]
                )->has(Signature::factory(1, ['signature_ceo' => $signature]))
            )
            ->has(Block::factory(2))
        ->create(['name' => 'Alfa Teste P']);
        // STATUS DRAFT
        Condominia::factory()
            ->has(AddressCondominia::factory())
        ->create(['name' => 'Teste Address D']);



        // Condominia::factory()->has(AddressCondominia::factory())->has(ContractCondominia::factory(1, ['ceo_id' => $ceo->account->id]))->has(Block::factory(2))->create(['name' => 'Alfa Teste']);

    }
}
