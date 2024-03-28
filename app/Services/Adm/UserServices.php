<?php

namespace App\Services\Adm;

use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\DataTransferObject\User\UserAdmDTO;
use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Exception;
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
    public function createResponsable( ResponsibleDTO $responsible)
    {
        try{
            DB::beginTransaction();
            $user = User::create([
                'name'=> $responsible->name,
                'email' => $responsible->email,
                'role_id' => $responsible->role_id,
                'password' => $responsible->password
            ]);

            Account::create([
                'person' =>$responsible->person,
                'genre' =>$responsible->genre,
                'birthday' =>$responsible->birthday,
                'notifications' =>$responsible->notifications,
                'phone' =>$responsible->phone,
                'telephone'=>$responsible->telephone,
                'condominia_id'=>$responsible->condominia_id,
                'user_id' => $user->id
            ]);

            DB::commit();
            return $responsible;
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Problema ao cria conta do responsavel!');
        }

        // $user = new User();
        // $user->name = $responsable->name;
        // $user->email = $responsable->email;
        // $user->role_id = $responsable->role_id;
        // $user->password = Hash::make($responsable->password);
        // $user->saveOrFail();
        // return $user;
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
