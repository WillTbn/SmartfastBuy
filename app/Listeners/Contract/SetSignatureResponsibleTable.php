<?php

namespace App\Listeners\Contract;

use App\Services\Adm\SignatureServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SetSignatureResponsibleTable
{

    public SignatureServices $signatureServices;
    /**
     * Create the event listener.
     */
    public function __construct(
        SignatureServices $signatureServices
    )
    {
        Log::info('Estou no construct de '.__CLASS__);
        $this->signatureServices = $signatureServices;
        // logger($this->signatureServices);
    }
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->signatureServices->updateStart($event->contract);
    }
}
