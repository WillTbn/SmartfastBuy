<?php

namespace App\Observers;

use App\Models\Apartment;

class ApartmentObserver
{
    /**
     * Handle the Apartment "created" event.
     */
    public function created(Apartment $apartment): void
    {
        // dd('from ApartmentObserver Created', $apartment);
    }

    /**
     * Handle the Apartment "updated" event.
     */
    public function updated(Apartment $apartment): void
    {
        // dd('from ApartmentObserver updated', $apartment);
    }

    /**
     * Handle the Apartment "deleted" event.
     */
    public function deleted(Apartment $apartment): void
    {

        // dd('estou aqui --> ', $apartment->account_client()->existis());
        if($apartment->account_client()->exists()){
            throw new \Exception('Este apartamento possui usuário associado e naõ pode ser deletado!');
        }
    }

    /**
     * Handle the Apartment "restored" event.
     */
    public function restored(Apartment $apartment): void
    {

        //
    }

    /**
     * Handle the Apartment "force deleted" event.
     */
    public function forceDeleted(Apartment $apartment): void
    {

    }
}
