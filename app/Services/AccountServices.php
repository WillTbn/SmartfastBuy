<?php

namespace App\Services;

use App\DataTransferObject\Account\AccountDTO;
use App\Models\Account;

class AccountServices
{
    public function updateAccount( AccountDTO $account,  int $user_id, ?string $image = null): Account
    {
        $acnt = Account::where('user_id', $user_id)->first();
        $acnt->name = $account->name;
        $acnt->person = $account->person;
        $acnt->genre = $account->genre;
        $acnt->birthday = $account->birthday;
        $acnt->notifications = $account->notifications;
        $acnt->telephone = $account->telephone;
        $acnt->phone = $account->phone;
        $acnt->apartment_id = $account->apartment_id;
        if($image){
            $acnt->avatar = $image;
        }
        $acnt->saveOrFail();

        return $acnt;

    }
}
