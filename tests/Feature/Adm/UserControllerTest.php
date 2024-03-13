<?php

namespace Tests\Feature\Adm;

use App\Models\Condominia;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_created_master_user()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'master']);

        $this->actingAs($user)->post(route('users.create', [
            'name' =>"Fulano e tal",
            'password' =>"123456789",
            'password_confirmation' =>"123456789",
            'email' =>'j@live.com',
            'person' =>22233344455,
            'genre' =>"O",
            'birthday' =>"2003/04/01",
            'notifications' =>"accepted",
            'phone' =>"21999949999",
            'telephone'=>"21999949999",
            'role_id' => $role->id
        ]));
        $this->assertDatabaseHas('accounts', [
            'person' =>   22233344455,
        ]);
    }
    public function test_created_seller_user()
    {
        $cond = Condominia::factory()->create();
        $user = User::factory()->create();
        $master = Role::factory()->create(['name' => 'master']);
        $seller = Role::factory()->create(['name' => 'Vendedor']);

        $this->actingAs($user)->post(route('users.create', [
            'name' =>"Fulano e tal",
            'password' =>"123456789",
            'password_confirmation' =>"123456789",
            'email' =>'j@live.com',
            'person' =>22233344455,
            'genre' =>"O",
            'birthday' =>"2003/04/01",
            'notifications' =>"accepted",
            'phone' =>"21999949999",
            'telephone'=>"21999949999",
            'role_id' => $seller->id,
            'condominia_id' =>$cond->id
        ]));
        $this->assertDatabaseHas('accounts', [
            'person' =>   22233344455,
        ]);
    }
}
