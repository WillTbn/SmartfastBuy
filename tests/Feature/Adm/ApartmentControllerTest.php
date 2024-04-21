<?php

namespace Tests\Feature\Adm;

use App\Models\Apartment;
use App\Models\Block;
use App\Models\Condominia;

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
        $reto->assertStatus(200);

    }
    public function test_apartment_created()
    {


        $user = \App\Models\User::factory()->create();
        $condominia = Condominia::factory()->create();

        $block = Block::factory()->create(
            ['name' => 'Vivendas teste', 'condominia_id' =>$condominia->id]
        );
        $this->actingAs($user)->post(route('apartment.create', [
            'number' => 105,
            'condominia_id' => $condominia->id,
            'block_id' => $block->id,
        ]));

        $this->assertDatabaseHas('apartments', [
            'number' => 105,
            'condominia_id' => $condominia->id,
            'block_id' => $block->id,
        ]);

    }
    public function test_apartment_deleted()
    {
        $user = \App\Models\User::factory()->create();
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
