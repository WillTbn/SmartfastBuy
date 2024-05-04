<?php

namespace App\Observers;

use App\Enums\ContractStates;
use App\Events\Ceo\Signature\SetSignatureCeo;
use App\Events\Responsible\SetSignatureResponsible;
use App\Events\Signature\SetSignatureContract;
use App\Models\ContractCondominia;
use App\Services\CondominiaServices;
use Illuminate\Support\Facades\Log;

class ContractCondominiaObserver
{
    private CondominiaServices $condominiaServices;
    public function __construct(
        CondominiaServices $condominiaServices
    )
    {
        $this->condominiaServices = $condominiaServices;
    }
    /**
     * Handle the ContractCondominia "created" event.
     */
    public function created(ContractCondominia $contractCondominia): void
    {
        Log::debug('Entrei no '.__CLASS__);
        if($contractCondominia->isDirty('ceo_id')){
            Log::info('Dispara event, para assinatura do ceo'.json_encode($contractCondominia));
            event(new SetSignatureCeo($contractCondominia));
        }else{
            $cond = $this->condominiaServices->getFirst($contractCondominia->condominia_id);
            Log::debug('Esse contrato não foi assinado pelo ceo_id'.json_encode( $cond));
            $this->condominiaServices->updatedStatus( $cond, ContractStates::Initial);
        }

        if($contractCondominia->isDirty('responsible_id')){
            Log::info('Dispara event, para assinatura do responsible');
            event(new SetSignatureResponsible($contractCondominia));
        }
    }

    /**
     * Handle the ContractCondominia "updated" event.
     */
    public function updated(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "deleted" event.
     */
    public function deleted(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "restored" event.
     */
    public function restored(ContractCondominia $contractCondominia): void
    {
        //
    }

    /**
     * Handle the ContractCondominia "force deleted" event.
     */
    public function forceDeleted(ContractCondominia $contractCondominia): void
    {
        //
    }
}
