<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
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

        User::factory()
        ->has(Account::factory())
        ->create([
            'name'=>'Administrador User',
            'email'=> env('ADMIN_EMAIL', fake()->email()),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'role_id' => RoleEnum::MASTER
        ]);
        User::factory()
        ->has(Account::factory())
        ->create([
            'name'=>'Responsible User',
            'email'=> env('RESP_EMAIL', 'responsible@live.com'),
            'password' => bcrypt(env('RESP_PASSWORD', 'resp123')),
            'role_id' => RoleEnum::RESPONSIBLE
        ]);

        User::factory()
        ->has(Account::factory())
        ->create([
            'name'=>'Seller User',
            'email'=> env('SELLER_EMAIL', 'seller@live.com'),
            'password' => bcrypt(env('SELLER_PASSWORD', 'seller123')),
            'role_id' => RoleEnum::SELLER
        ]);

    }
}
