<?php

namespace Tests\Feature\Adm;

use App\Models\Condominia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CondominiaControllerTest extends TestCase
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
    public function test_condominia_created()
    {
        $user = User::factory()->create();

        Condominia::factory()->create();

        $this->actingAs($user)->post(route('condominia.create', [
            'name' => 'Teste Vivendas Teste',
        ]));

        $this->assertDatabaseHas('condominias', [
            'name' => 'Teste Vivendas Teste'
        ]);

    }
}
