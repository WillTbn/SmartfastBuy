<?php

namespace App\Listeners\Contract;

use App\Models\ContractCondominia;
use App\Services\Adm\SignatureServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SetSignatureCeoTable implements ShouldQueue
{
    public SignatureServices $signatureServices;
    /**
     * Create the event listener.
     */
    public function __construct(
        SignatureServices $signatureServices
    )
    {
        Log::alert('Estou no construct de '.__CLASS__);
        $this->signatureServices = $signatureServices;
        // logger($this->signatureServices);
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        logger('Listener Initial '.__CLASS__);
        $this->signatureServices->setCreate($event->contract);
        logger('Listener finally '.__CLASS__);
    }
}
