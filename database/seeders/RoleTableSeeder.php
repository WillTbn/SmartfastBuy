<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Ability;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Ability::create([
            'name'=> 'all-access'
        ]);

        Ability::create([
            'name'=> 'users-access'
        ]);
        Ability::create([
            'name'=> 'products-access'
        ]);
        Ability::create([
            'name'=> 'condominia-access'
        ]);
        Ability::create([
            'name'=> 'invite-access'
        ]);

        Role::create([
            'name'=>'Master'
        ]);

        Role::create([
            'name'=>'Seller'
        ]);
        Role::create([
            'name'=>'Responsible'
        ]);

        // $seller = Role::where('name', 'Seller')->first()->id;
        // $responsible = Role::where('name', 'Responsible')->first()->id;
        $abilitySeller = Ability::whereNot('name','all-access')->pluck('id');
        $abilityResp = Ability::where('name','products-access')->orWhere('name','condominia-access')->pluck('id');

        DB::table('role_abilities')->insert([
            'role_id' => RoleEnum::MASTER,
            'ability_id' => Ability::where('name','all-access')->first()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach($abilitySeller as $ab){
            DB::table('role_abilities')->insert([
                'role_id' => RoleEnum::SELLER,
                'ability_id' => $ab,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        foreach($abilityResp as $ab){
            DB::table('role_abilities')->insert([
                'role_id' => RoleEnum::RESPONSIBLE,
                'ability_id' => $ab,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }




    }
}
