<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Account;
use App\Models\Role;
use App\Models\RoleAbility;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        $user = User::create([
            'name'=>'Administrador User',
            'email'=> env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'role_id' => $role->id
        ]);

        Account::create([
            'person' => '15222222224',
            'telephone' => '21 23232323',
            'phone' => '21 988887575',
            'birthday' => '1990-08-03',
            'notifications' => 'accepted',
            'user_id' => $user->id
        ]);

    }
}
