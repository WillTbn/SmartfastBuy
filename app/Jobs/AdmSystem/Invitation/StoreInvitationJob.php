<?php

namespace App\Jobs\AdmSystem\Invitation;

use App\DataTransferObject\Invitation\InvitationDTO;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class StoreInvitationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    // private InvitationServices $inviteServices;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected InvitationDTO $dto)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invite = new Invitation();
        $invite->email = $this->dto->email;
        $invite->name = $this->dto->name;
        $invite->data = $this->dto->data;
        $invite->user_id = $this->dto->user_id;
        $invite->token = $this->dto->token;
        $invite->created_at = now();
        $invite->saveOrFail();
        // $this->inviteServices->sendCreate(
        //     $this->dto
        // );
    }
}
