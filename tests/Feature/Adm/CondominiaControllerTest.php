<?php

namespace Tests\Feature\Adm;

use App\Enums\ContractStates;
use App\Enums\RoleEnum;
use App\Models\Ability;
use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Role;
use App\Models\RoleAbility;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class CondominiaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_condominia_created()
    {
        // $faker = Fake\Factory::create('pt_BR');
        $user = User::factory()->create();

        Condominia::factory()->create();

        $this->actingAs($user)->post(route('condominia.create', [
            'name' => 'Teste Vivendas Teste',
            'road' => fake()->streetName(),
            'state' => fake()->state(),
            'district' => fake()->citySuffix(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
            'number' => fake()->buildingNumber(),
            'document_name' => 'documento.pdf',
            'initial_date' => '',
            'final_date' => '',
        ]));
        $addres = AddressCondominia::first();

        $this->assertDatabaseHas('address_condominias', [
            'road' => $addres->road
        ]);
        $this->assertDatabaseHas('condominias', [
            'name' => 'Teste Vivendas Teste'
        ]);

    }
    public function test_condominia_status_draft()
    {
        $user = User::factory()->create();
        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
        ->create(['name' => 'Teste']);

        $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));

        $response->assertStatus(200);
        $response->assertSee('Teste');

        $this->assertDatabaseHas('condominias', [
            'contract_status' =>  ContractStates::Draft,
        ]);

    }
    public function test_condominia_status_initial()
    {
        $user = User::factory()->create();
        // dd($user);
        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominia::factory())
        ->create(['name' => 'Teste']);

        $response = $this->actingAs($user)->get(route('condominia.getOne',[$cond->id]));

        $response->assertStatus(200);
        $this->assertDatabaseHas('condominias', [
            'contract_status' =>  ContractStates::Initial,
        ]);

    }
    public function test_condominia_status_pending()
    {
        $user = User::factory()
            ->has(Account::factory())
        ->create();
        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominia::factory(1,['ceo_id' => $user->id]))
        ->create(['name' => 'Teste']);
        $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));

        $response->assertStatus(200);

        $this->assertDatabaseHas('condominias', [
            'contract_status' =>  ContractStates::Pending,
        ]);
    }
    public function test_condominia_status_start()
    {
        $user = User::factory() ->has(Account::factory())->create();
        $respo = User::factory()
            ->has(Account::factory())
            ->has(
                Role::factory()
                    ->has(Ability::factory()
                        ->has(RoleAbility::factory()
                    )
                )
            )
        ->create([
            'name'=>'Responsible User',
            'email'=> fake()->email(),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'role_id' => RoleEnum::Responsible
        ]);

        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominia::factory(1, ['ceo_id' => $user->id, 'responsible_id' => $respo->id]))
        ->create(['name' => 'Teste']);

        $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));
        // dd($response);

        $response->assertStatus(200);
        $this->assertDatabaseHas('condominias', [
            'contract_status' =>  ContractStates::Start,
        ]);
    }
}
