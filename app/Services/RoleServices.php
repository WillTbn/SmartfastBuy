<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleServices
{
    public function getRoles(){
        return Role::all();
    }
    public function getRoleResponsibleId()
    {
        // $responseId = Role::where('name', 'Responsavel')->first();
        $responseId = DB::table('roles')->where('name', 'Responsible')->value('id');
        return $responseId;
    }
}
