<?php

namespace Tests\Feature\Adm;

use App\Models\AccountClient;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Client;
use App\Models\Condominia;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartmentDatabaseControllerTest extends TestCase
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
     //  Rever esse teste <---------------- Não esta retornando 500 - 302
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
}
