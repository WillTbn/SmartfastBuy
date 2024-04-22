<?php

namespace Tests\Feature\Adm;

use App\Enums\RoleEnum;
use App\Models\Ability;
use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Condominia;
use App\Models\Role;
use App\Models\RoleAbility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ApartmentControllerTest extends TestCase
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
    public function test_apartment_index()
    {
        $reto = $this->get(route('apartment.index'));
        $reto->assertStatus(302);

    }
    public function test_apartment_created()
    {

        $user = User::factory()
            ->has(Account::factory())
        ->create();
        $condominia = Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(Block::factory())
        ->create();

        $reto = $this->actingAs($user, 'web')->post(route('apartment.create', [
            'number' => 105,
            'condominia_id' => $condominia->id,
            'block_id' => $condominia->blocks[0]->id,
        ]));

        $reto->assertStatus(302);

        $this->assertDatabaseHas('apartments', [
            'number' => 105,
            'condominia_id' => $condominia->id,
            'block_id' => $condominia->blocks[0]->id,
        ]);

    }
    public function test_apartment_deleted()
    {
        $user = User::factory()
            ->has(Account::factory())
            ->has(
                Role::factory(1, ['name' =>  RoleEnum::Responsible->name])
                    ->has(Ability::factory()
                        ->has(RoleAbility::factory()
                    )
                )
            )
        ->create([
            'name'=>'Responsible User',
            'email'=> env('ADMIN_EMAIL', fake()->email()),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
            'role_id' => RoleEnum::Responsible
        ]);
        $condominia = Condominia::factory()->create();

        $block = Block::factory()->create(
            ['name' => 'Vivendas teste', 'condominia_id' =>$condominia->id]
        );
        $apto = Apartment::factory()->create([
            'number' => 106,
            'floor' => 1,
            'block_id' =>  $block->id,
            'condominia_id' => $condominia->id
        ]);

        $this->actingAs($user)->delete(route('apartment.delete', $apto->id));
        // dd($apto);

        $this->assertDatabaseMissing('apartments', [
            'number' => 106,
            'floor' => 1,
            'condominia_id' => $condominia->id,
            'block_id' => $block->id,
        ]);
    }

    // public function teste_redirect_apartment_created()
    // {
    //     $user = \App\Models\User::factory()->create();
    //     $this->actingAs($user);
    //     $condominia = Condominia::factory()->create();
    //     $block = Block::factory()->create(
    //         ['name' => 'Vivendas teste', 'condominia_id' =>$condominia->id]
    //     );

    //     $response = $this->postJson('apartments/', [
    //         'number' => 105,
    //         'condominia_id' => $condominia->id,
    //         'block_id' => $block->id,
    //     ]);

    //     $response->assertSessionHas('success', 'Apartamento criado com sucesso!');
    //     $response->assertStatus(200);
    //     $response->assertRedirect('/apartments');
    // }
}
