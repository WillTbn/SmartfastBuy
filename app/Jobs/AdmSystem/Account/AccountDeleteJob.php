<?php

namespace App\Jobs\AdmSystem\Account;

use App\Services\Adm\AccountServices;
use App\Services\Adm\UserServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccountDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $user_id,
        protected UserServices $servicesUser,
        protected AccountServices $serviceAcc,
    )
    {
        // $this->servicesUser = $servicesUser;
        // $this->serviceAcc = $serviceAcc;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->serviceAcc->deleted($this->user_id);
        $this->servicesUser->deleted($this->user_id);

    }
}
