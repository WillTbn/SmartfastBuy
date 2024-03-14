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

        $user = User::create([
            'name'=>'Administrador User',
            'email'=> env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'role_id' => Role::where('name', 'Master')->first()->id
        ]);

        Account::create([
            'person' => fake('pt_BR')->cpf(),
            'telephone' => fake('pt_BR')->phoneNumber(),
            'phone' => fake('pt_BR')->cellphone(),
            'birthday' => fake()->date('Y-m-d'),
            'notifications' => 'accepted',
            'user_id' => $user->id
        ]);
        $responsable = User::create([
            'name'=>'Responsible User',
            'email'=> env('RESP_EMAIL', 'responsible@live.com'),
            'password' => bcrypt(env('RESP_PASSWORD', 'resp123')),
            'role_id' => Role::where('name', 'Seller')->first()->id
        ]);

        Account::create([
            'person' => fake('pt_BR')->cpf(),
            'telephone' => fake('pt_BR')->phoneNumber(),
            'phone' => fake('pt_BR')->cellphone(),
            'birthday' => fake()->date('Y-m-d'),
            'notifications' => 'accepted',
            'user_id' => $responsable->id
        ]);
        $seller = User::create([
            'name'=>'Seller User',
            'email'=> env('SELLER_EMAIL', 'seller@live.com'),
            'password' => bcrypt(env('SELLER_PASSWORD', 'seller123')),
            'role_id' => Role::where('name', 'Responsible')->first()->id
        ]);

        Account::create([
            'person' => fake('pt_BR')->cpf(),
            'telephone' => fake('pt_BR')->phoneNumber(),
            'phone' => fake('pt_BR')->cellphone(),
            'birthday' => fake()->date('Y-m-d'),
            'notifications' => 'accepted',
            'user_id' => $seller->id
        ]);

    }
}
