<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleServices
{
    public function getRoles(){
        return Role::all();
    }
}
