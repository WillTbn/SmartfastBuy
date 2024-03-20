<?php

namespace Tests\Feature\Adm;

use App\Mail\AdmSystem\Responsible\UserConfigAsResponsible;
use App\Models\Account;
use App\Models\Condominia;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ResponsableControllerTest extends TestCase
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
            'person' =>   22233344455,
        ]);

        $this->assertDatabaseHas('condominias', [
            'responsable_id' =>   2,
        ]);

        //verificar se não foi mandado o e-mail
        //

        // verificar o envio do email
        // Mail::assertSent(Emailquequerteste::class)
    }
    public function test_responsible_event_email()
    {
        $cond = Condominia::factory()->create();
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Responsible']);
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
        //verificar se não foi disparado
        // Event::assertNotDispatched();

        // verificar se foi disparado o evento
        // Event::assertDispatched();

        //verificar se não foi mandado o e-mail
        // Mail::assertNothingSent();

        // verificar o envio do email
        // Mail::assertSent(Emailquequerteste::class)


    }
    // ESSE TESTE TEM QUE IR PARA UM USERCONTROLLERTESTE
    // public function test_user_created()
    // {
    //     $cond = Condominia::factory()->create();
    //     $user = User::factory()->create();
    //     $role = Role::factory()->create([
    //         "name" => 'Master'
    //     ]);

    //     $this->actingAs($user)->post(route('users.create', [
    //         'name' =>"Fulano e tal",
    //         'password' =>"123456789",
    //         'password_confirmation' =>"123456789",
    //         'email' =>$user->email,
    //         'role_id' => $role->id,
    //         'person' =>22233344455,
    //         'genre' =>"O",
    //         'birthday' =>"2003/04/01",
    //         'notifications' =>"accepted",
    //         'phone' =>"21 99994-9999",
    //         'telephone'=>"21 99994-9999",

    //     ]));
    //     $this->assertDatabaseHas('users', [
    //         'email' =>   $user->email,
    //     ]);
    // }
}
