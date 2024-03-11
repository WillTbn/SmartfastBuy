<?php

namespace App\Services\Adm;

use App\DataTransferObject\Responsable\ResponsableDTO;
use App\DataTransferObject\User\UserAdmDTO;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
       return $user;
    }
    public function createResponsable( ResponsableDTO $responsable)
    {
        $user = new User();
        $user->name = $responsable->name;
        $user->email = $responsable->email;
        $user->role_id = $responsable->role_id;
        $user->password = Hash::make($responsable->password);
        $user->saveOrFail();
        return $user;
    }
    public function getAllUsers(){
        $user = DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select(
                'users.id',
                'users.email',
                'users.name',
                'users.email_verified_at as verify',
                'roles.name as role',
            )
            ->where('role_id', '!=', 1)
        ->get();
        // $user = User::where('id', '!=', auth()->user()->id)->with('role')->get();

        return $user;
    }
    public function deleted(int $id){
        $user = User::find($id);

        $user->delete();

    }
}
