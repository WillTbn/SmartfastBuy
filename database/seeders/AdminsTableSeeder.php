<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Admin;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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


        $role = Role::create([
            'name'=>'Master'
        ]);

        $vend = Role::create([
            'name'=>'Vendedor'
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

        Admin::create([
            'name'=>'Administrador User',
            'email'=> env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
            'person' => '15222222224',
            'genre'=> 'O',
            'birthday'=> '1990-08-03',
            'role_id' => $role->id
        ]);
    }
}
