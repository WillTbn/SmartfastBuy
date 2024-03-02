<?php

namespace Tests\Feature\Adm;

use App\Jobs\AdmSystem\Invitation\SendEmailInvitationJob;
use App\Jobs\AdmSystem\SendEmailInvatationJob;
use App\Models\Apartment;
use App\Models\Block;
use App\Models\Condominia;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class InvitationControllerTest extends TestCase
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
    public function test_invitation_created()
    {
        $user = User::factory()->create();

        $cond = Condominia::factory()->create();
        $block = Block::factory()->create(
            ['name' => 'Vivendas teste', 'condominia_id' =>$cond->id]
        );
        $apto =  Apartment::factory()->create([
            'number' => 106,
            'floor' => 1,
            'block_id' =>  $block->id,
            'condominia_id' => $cond->id
        ]);

        $invitation = $this->actingAs($user)->post(route('invites.create', [
            'name' => 'Fulano de tal',
            'email'=>   'teste@live.com',
            'person' => '111.222.333-44',
            'birthday' => fake()->date(),
            'apartment_id' => $apto->id
        ]));


        $this->assertDatabaseHas('invitations', [
            'email'=>   'teste@live.com',
        ]);

    }
    public function test_job_send_email()
    {
        $user = User::factory()->create();

        $cond = Condominia::factory()->create();
        $block = Block::factory()->create(
            ['name' => 'Vivendas teste', 'condominia_id' =>$cond->id]
        );
        $apto =  Apartment::factory()->create([
            'number' => 106,
            'floor' => 1,
            'block_id' =>  $block->id,
            'condominia_id' => $cond->id
        ]);
        $invitation = Invitation::factory()->create([
            'name' => 'Fulano de tal',
            'email'=>   'teste@live.com',
            'user_id' => $user->id,
            'data' => 'algo qualquer',
            'token'=> 'bdNiypOWANe9QepXeUIOF1QYorgT0Tqen33333'
        ]);


        // $invitation = $this->actingAs($user)->post(route('invites.create', [
            //         'name' => 'Fulano de tal',
            //         'email'=>   'teste@live.com',
            //         'person' => '111.222.333-44',
            //         'birthday' => fake()->date(),
            //         'apartment_id' => $apto->id
            //     ]));
        Queue::fake();
        dispatch(new SendEmailInvatationJob( $invitation));


        Queue::assertPushed(SendEmailInvatationJob::class);

    }
}
