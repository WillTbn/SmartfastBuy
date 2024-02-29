<?php

namespace Tests\Feature\Adm;

use App\Models\Block;
use App\Models\Condominia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlockControllerTest extends TestCase
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
    public function test_floors_block_created()
    {
        $user = \App\Models\User::factory()->create();

        $condominia = Condominia::factory()->create();

        $block = Block::factory()->create(
            ['name' => 'Vivendas teste', 'condominia_id' =>$condominia->id]
        );

        $this->actingAs($user)->post(route('blocks.floorsBlock', [
            'apartment_start' => 101,
            'apartment_finally' =>104,
            'block_id' => $block->id,
            'condominia_id' => $block->condominia_id,
        ]));

        $this->assertDatabaseHas('apartments', [
            'number' => 103,
            'condominia_id' => $block->condominia_id,
            'block_id' => $block->id,
        ]);

    }
}
