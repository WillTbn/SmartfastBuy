<?php

namespace Tests\Feature\Adm;

use App\Models\Condominia;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CondominiaControllerTesst extends TestCase
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
}
