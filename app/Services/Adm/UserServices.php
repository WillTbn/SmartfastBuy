<?php

namespace App\Services\Adm;

use App\DataTransferObject\User\UserAdmDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function createUser( UserAdmDTO $adm)
    {
        $user = new User();
        $user->name = $adm->name;
        $user->email = $adm->email;
        $user->role_id = $adm->role_id;
        $user->password = Hash::make($adm->password);
        $user->saveOrFail();
    //    $user = User::create([
    //     'name' => $adm->name,
    //     'email' => $adm->email,
    //     'role_id' => (int) $adm->role_id,
    //     'password' => Hash::make($adm->password),
    //    ]);

       return $user;
    }
    public function getAllUsers(){
        $user = User::where('id', '!=', auth()->user()->id)->with('role')->get();

        return $user;
    }
    public function deleted(int $id){
        $user = User::find($id);

        $user->delete();

    }
}
