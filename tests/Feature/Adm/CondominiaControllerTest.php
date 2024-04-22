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

        $this->assertDatabaseHas('condominias', [
            'name' => 'Teste Vivendas Teste'
        ]);

    }
    // public function test_condominia_status_draft()
    // {
    //     // $user = User::factory()
    //     //         ->has(
    //     //             Role::factory()
    //     //                 ->has(Ability::factory()
    //     //                     ->has(RoleAbility::factory()
    //     //                 )
    //     //             )
    //     //         )
    //     //     ->create([
    //     // 'name'=>'Administrador User',
    //     // 'email'=> env('ADMIN_EMAIL', fake()->email()),
    //     // 'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
    //     // 'role_id' => RoleEnum::Master
    //     // ]);
    //     $user = User::factory()->create();

    //     $cond = Condominia::factory()
    //         ->has(AddressCondominia::factory())
    //     ->create(['name' => 'Teste']);

    //     $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));
    //     $response->assertStatus(200);
    //     $response->assertSee('Teste');
    //     // $response->assertSee('draft');
    //     $this->assertEquals(ContractStates::Draft, $cond->contract_status);

    // }
    // public function test_condominia_status_initial()
    // {
    //     $user = User::factory()->create();
    //     // dd($user);
    //     $cond = Condominia::factory()
    //         ->has(AddressCondominia::factory())
    //         ->has(ContractCondominia::factory())
    //     ->create(['name' => 'Teste']);

    //     $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));

    //     $this->assertEquals('Administrador User', $user->name);
    //     $response->assertStatus(200);

    //     $this->assertEquals(ContractStates::Initial, $cond->contract_status);
    // }
    // public function test_condominia_status_pending()
    // {
    //     $user = User::factory()->create();

    //     $cond = Condominia::factory()
    //         ->has(AddressCondominia::factory())
    //     ->create(['name' => 'Teste']);
    //     $contract = ContractCondominia::factory()->create([
    //         'document_name' => 'default-contract.pdf',
    //         'initial_date' => now(),
    //         'ceo_id' => $user->account->id,
    //         'condominia_id' => $cond->id
    //     ]);
    //     $sign = Signature::factory()->create([
    //         'contract_condominia_id' => $contract->id,
    //         'signature_ceo' => Hash::make($user->account->person),
    //         // 'signature_ceo' => Hash::make($user->account->person),
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);
    //     // dd($sign);
    //     $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));
    //     $this->assertEquals('Administrador User', $user->name);
    //     $response->assertStatus(200);

    //     $this->assertEquals(ContractStates::Pending, $cond->contract_status);
    // }
    // public function test_condominia_status_start()
    // {
    //     $user = User::factory()->create();
    //     $respo = User::factory()
    //         ->has(Account::factory())
    //         ->has(
    //             Role::factory()
    //                 ->has(Ability::factory()
    //                     ->has(RoleAbility::factory()
    //                 )
    //             )
    //         )
    //     ->create([
    //         'name'=>'Responsible User',
    //         'email'=> fake()->email(),
    //         'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
    //         'role_id' => RoleEnum::Responsible
    //     ]);

    //     $cond = Condominia::factory()
    //         ->has(AddressCondominia::factory())
    //     ->create(['name' => 'Teste']);
    //     $contract = ContractCondominia::factory()->create([
    //         'document_name' => 'default-contract.pdf',
    //         'initial_date' => now(),
    //         'ceo_id' => $user->account->id,
    //         'responsible_id' => $respo->account->id,
    //         'condominia_id' => $cond->id,
    //     ]);
    //     Signature::factory()->create([
    //         'contract_condominia_id' => $contract->id,
    //         'signature_ceo' => Hash::make($user->account->person),
    //         'signature_responsible' => Hash::make($respo->account->person),
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);
    //     // dd(ContractCondominia::with(['responsible'])->first());

    //     $response = $this->actingAs($user)->get(route('condominia.getOne',[1]));
    //     // dd($response);
    //     $this->assertEquals('Administrador User', $user->name);
    //     $response->assertStatus(200);

    //     $this->assertEquals(ContractStates::Start, $cond->contract_status);
    // }
}
