<?php

namespace App\Jobs\AdmSystem\Responsible;

use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\DataTransferObject\User\UserAdmDTO;
use App\Mail\AdmSystem\InvitationEmail;
use App\Mail\AdmSystem\Responsable\WelcomeResponsableEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailWelcomeResponsableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ResponsibleDTO $dto)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to("contato@smartfastbuy.com.br")->send(new WelcomeResponsableEmail($this->dto));
    }
}
