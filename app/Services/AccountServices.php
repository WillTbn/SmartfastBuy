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
    public function createdAccount(AccountDTO $account)
    {
        $ac = new Account();
        $ac->name = $account->name;
        $ac->user_id = $account->user_id;
        $ac->person = $account->person;
        $ac->genre = $account->genre;
        $ac->birthday = $account->birthday;
        $ac->notifications = $account->notifications;
        $ac->telephone = $account->telephone;
        $ac->phone = $account->phone;
        $ac->apartment_id = $account->apartment_id;
        $ac->saveOrFail();


        return $ac;
    }
}
