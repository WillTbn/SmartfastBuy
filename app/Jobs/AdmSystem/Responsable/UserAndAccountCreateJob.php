<?php

namespace App\Jobs\AdmSystem\Responsable;

use App\DataTransferObject\Responsable\ResponsableDTO;
use App\Services\Adm\AccountServices;
use App\Services\Adm\UserServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserAndAccountCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ResponsableDTO $dto,
        protected UserServices $userServices,
        protected AccountServices $accountServices,
    )
    {


    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->userServices->createResponsable($this->dto);
        $this->accountServices->createAccountResponsable($this->dto, $user->id);
    }
}
