<?php

namespace Tests\Feature\Adm;

use App\Models\Block;
use App\Models\Condominia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
