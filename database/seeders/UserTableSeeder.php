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
            'role_id' => RoleEnum::Master
        ]);
        User::factory()
            ->has(Account::factory())
        ->create([
            'name'=>'Responsible User',
            'email'=> env('RESPO_EMAIL', fake()->email()),
            'password' => bcrypt(env('RESP_PASSWORD', 'resp123')),
            'role_id' => RoleEnum::Responsible
        ]);

        User::factory()
            ->has(Account::factory())
        ->create([
            'name'=>'Seller User',
            'email'=> env('SELLE_EMAIL', fake()->email()),
            'password' => bcrypt(env('SELLER_PASSWORD', 'seller123')),
            'role_id' => RoleEnum::Seller
        ]);

    }
}
