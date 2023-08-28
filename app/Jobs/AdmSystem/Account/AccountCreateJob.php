<?php

namespace App\Jobs\AdmSystem\Account;

use App\DataTransferObject\User\UserAdmDTO;
use App\Services\Adm\AccountServices;
use App\Services\Adm\UserServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccountCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    // public UserServices $servicesUser;
    // public AccountServices $serviceAcc;
    public function __construct(
        protected UserAdmDTO $dto,
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
        $user = $this->servicesUser->createUser($this->dto);

        $account = $this->serviceAcc->createdAccount($this->dto, $user->id);
    }
}
