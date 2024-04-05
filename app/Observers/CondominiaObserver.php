<?php

namespace App\Observers;

use App\Events\Responsible\SetResponsibleCondominia;
use App\Models\Condominia;

class CondominiaObserver
{
    /**
     * Handle the Condominia "created" event.
     */
    public function created(Condominia $condominia): void
    {
        // dd('ESTOU NO CREATED');
    }

    /**
     * Handle the Condominia "updated" event.
     */
    public function updated(Condominia $condominia): void
    {
        if($condominia->isDirty('responsible_id')){
            event(new SetResponsibleCondominia($condominia));
        }
    }

    /**
     * Handle the Condominia "deleted" event.
     */
    public function deleted(Condominia $condominia): void
    {
        //
    }

    /**
     * Handle the Condominia "restored" event.
     */
    public function restored(Condominia $condominia): void
    {
        //
    }

    /**
     * Handle the Condominia "force deleted" event.
     */
    public function forceDeleted(Condominia $condominia): void
    {
        //
    }
}
