<?php

namespace Tests\Feature\Adm;

use App\Mail\AdmSystem\Responsible\UserConfigAsResponsible;
use App\Models\Account;
use App\Models\Condominia;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ResponsibleControllerTest extends TestCase
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
    public function test_responsible_created()
    {
        Mail::fake();
        $cond = Condominia::factory()->create();
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Responsible']);
        Mail::assertNotSent(UserConfigAsResponsible::class);
        $this->actingAs($user)->post(route('responsable.create', [
            'name' =>fake()->name(),
            'password' =>"123456789",
            'password_confirmation' =>"123456789",
            'email' =>fake()->email(),
            // 'person' =>fake('pt_BR')->cpf(),
            'person' =>"22233344455",
            'genre' =>"O",
            'birthday' =>"2003/04/01",
            'notifications' =>"accepted",
            'phone' =>"21999949999",
            'telephone'=>"21999949999",
            'condominia_id'=>$cond->id
        ]));

        Mail::assertSent(UserConfigAsResponsible::class);
        $this->assertDatabaseHas('accounts', [
            'person' =>   "22233344455",
        ]);

        $this->assertDatabaseHas('condominias', [
            'responsible_id' =>   2,
        ]);
    }

}
