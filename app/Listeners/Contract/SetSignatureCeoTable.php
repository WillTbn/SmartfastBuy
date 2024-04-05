<?php

namespace App\Listeners\Contract;

use App\Services\Adm\SignatureServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetSignatureCeoTable
{
    private SignatureServices $signatureServices;
    /**
     * Create the event listener.
     */
    public function __construct(
        SignatureServices $signatureServices
    )
    {
        logger('Estou no construct de '.__CLASS__);
        $this->signatureServices = $signatureServices;
        logger($this->signatureServices);
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        logger('Listener Initial '.__CLASS__);
        $this->signatureServices->setCreate($event);
        logger('Listener finally '.__CLASS__);
    }
}
