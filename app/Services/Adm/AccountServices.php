<?php

namespace App\Services\Adm;

use App\DataTransferObject\User\UserAdmDTO;
use App\Models\Account;

class AccountServices
{

    public function createdAccount(UserAdmDTO $account, int $user_id)
    {

        $ac = new Account();
        $ac->user_id = $user_id;
        $ac->person = $account->person;
        $ac->genre = $account->genre;
        $ac->birthday = $account->birthday;
        $ac->notifications = $account->notifications;
        $ac->telephone = $account->telephone;
        $ac->phone = $account->phone;
        $ac->saveOrFail();
        return $ac;
    }
    public function deleted(int $user_id)
    {
        $account = Account::where('user_id', $user_id)->first();

        $account->delete();

    }

}
