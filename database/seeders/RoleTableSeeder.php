<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ab = Ability::create([
            'name'=> 'all-access'
        ]);

        $abv1 = Ability::create([
            'name'=> 'users-access'
        ]);
        $abv2 = Ability::create([
            'name'=> 'products-access'
        ]);
        $abv3 = Ability::create([
            'name'=> 'condominia-access'
        ]);


        $role = Role::create([
            'name'=>'Master'
        ]);

        $vend = Role::create([
            'name'=>'Seller'
        ]);
        $resp = Role::create([
            'name'=>'Responsible'
        ]);

        RoleAbility::create([
            'role_id' =>  $role->id,
            'ability_id'=> $ab->id
        ]);

        RoleAbility::create([
            'role_id' =>  $vend->id,
            'ability_id'=> $abv1->id
        ]);
        RoleAbility::create([
            'role_id' =>  $vend->id,
            'ability_id'=> $abv2->id
        ]);
        RoleAbility::create([
            'role_id' =>  $resp->id,
            'ability_id'=> $abv3->id
        ]);
    }
}
