<?php

namespace App\Listeners;

use App\Events\Responsible\SetResponsibleCondominia;
use App\Mail\AdmSystem\Responsible\UserConfigAsResponsible;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailResponsable implements ShouldQueue
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
    public function handle(SetResponsibleCondominia $event): void
    {
        logger('Listeener '.__CLASS__);
        $userSend = DB::table('users')->find($event->condominia->responsible_id);
        // dd($event->condominia->name);
        Mail::to('contato@smartfastbuy.com.br')->send( new UserConfigAsResponsible($event->condominia, $userSend));
    }
}
