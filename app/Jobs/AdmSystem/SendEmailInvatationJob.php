<?php

namespace App\Jobs\AdmSystem;

use App\Mail\Client\InvitationSendEmail;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailInvatationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected Invitation $dto)
    {
        //
    }

    /**
     * Execute the job.s
     *
     * @return void
     */
    public function handle()
    {
        Mail::to("jorgenunes@woza.com.br")->send(new InvitationSendEmail($this->dto));
    }
}
