<?php

namespace App\Listeners\Contract;

use App\Mail\AdmSystem\Contract\SetSignatureCeo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailContractToCeo
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
        logger('Listeener Initial aaasad '.__CLASS__);
        logger(json_encode($event));
        Mail::to(env('CONTACT_EMAIL', 'no_env_contact@smartfastbuy.com.br'))->send(new SetSignatureCeo($event->contract->ceo, $event->contract->condominia));
        logger('Listeener finish '.__CLASS__);
    }
}
