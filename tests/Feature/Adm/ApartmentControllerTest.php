<?php

namespace Tests\Feature\Adm;

use App\Models\AccountClient;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Client;
use App\Models\Condominia;
use Exception;
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
    //  Rever esse teste <----------------
    public function test_failed_assoc_user_apartment_deleted()
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
        $client = Client::factory()->create();
        $account = AccountClient::factory([
            'person' => '12345342774',
            'telephone' => '21 98989-9895',
            'phone' => '21 98989-9895',
            'genre' => 'O',
            'birthday' => '2023-02-25',
            'notifications' => 'accepted',
            'apartment_id' => $apto->id,
            'client_id' => $client->id,
        ])->create();

        $response = $this->actingAs($user)->delete(route('apartment.delete', $apto->id));

        // dd($response);

        $response->assertStatus(500);
        $response->assertSessionHasErrors('error', 'Este apartamento possui usuário associado e naõ pode ser deletado!');

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
