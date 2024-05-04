<?php

namespace App\Listeners\Contract;

use App\Mail\AdmSystem\Contract\SetSignatureResponsible;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailSignatureResponsible implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::info('Estou no '.__CLASS__);
        Mail::to(env('CONTACT_EMAIL', 'no_env_contact@smartfastbuy.com.br'))->send(new SetSignatureResponsible($event->contract->responsible, $event->contract->condominia));
    }
}
