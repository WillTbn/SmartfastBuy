<?php

namespace App\Jobs\Invitation;

use App\DataTransferObject\Invitation\InvitationUpdateDTO;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateInvitationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected InvitationUpdateDTO $dto)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invite = Invitation::find( $this->dto->id);
        $invite->email = $this->dto->email;
        $invite->name = $this->dto->name;
        $invite->data = $this->dto->data;
        $invite->user_id = $this->dto->user_id;
        $invite->token = $this->dto->token;
        $invite->saveOrFail();
    }
}
