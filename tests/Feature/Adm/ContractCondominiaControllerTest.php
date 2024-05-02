<?php

namespace Tests\Feature\Adm;

use App\Events\Signature\SetSignatureContract;
use App\Models\Account;
use App\Models\AddressCondominia;
use App\Models\Condominia;
use App\Models\ContractCondominia;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContractCondominiaControllerTest extends TestCase
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
    public function test_create_contract()
    {
        Storage::fake('pdf');
        Event::fake([SetSignatureContract::class]);
        $file = UploadedFile::fake()->create('testeDocument.pdf', 100, 'application/pdf');
        // dd($file);
        $user = User::factory()->create();
        // $responsible = User::factory()->has(Account::factory())->withRoleResponsible()->create();
        $cond = Condominia::factory()
            ->has(AddressCondominia::factory())
        ->create(['name' => 'Teste Condominia']);

        $response = $this->actingAs($user)->post(route('contract.create'), [
            'name' =>fake()->name(),
            'password' =>"123456789",
            'password_confirmation' =>"123456789",
            'email' =>fake()->email(),
            // 'person' =>fake('pt_BR')->cpf(),
            'person' =>"22233344455",
            'genre' =>"O",
            'birthday' =>"2003/04/01",
            'notifications' =>"accepted",
            'phone' =>"21999949999",
            'telephone'=>"21999949999",
            'condominia_id'=>$cond->id,
            'document' => $file,
            'initial_date' => "2023-03",
            'final_date' => "2024-04",
            'ceo' => true,
            // 'responsible_id' => $responsible->account->user_id,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('accounts', [
            'person' =>   "22233344455",
        ]);
        $this->assertDatabaseHas('contract_condominias', [
            'initial_date' =>   "2023-03",
            // 'condominia_id' =>    $cond->id,
        ]);


        Event::assertDispatched(SetSignatureContract::class);
        // $response->assertSee('Teste');

    }
    public function test_event_create_contract()
    {
        Event::fake([SetSignatureContract::class]);
        $user = User::factory()->has(Account::factory())->create();
        $signature = Hash::make($user->account->person.$user->account->birthday);
        Condominia::factory()
            ->has(AddressCondominia::factory())
            ->has(ContractCondominia::factory(
                1,
                ['ceo_id' => $user->account->id]
                )
            )
        ->create(['name' => 'Alfa Teste P']);
        // dd($cond->contractCondominia->signature);

        Event::assertDispatched(SetSignatureContract::class);
    }
}
