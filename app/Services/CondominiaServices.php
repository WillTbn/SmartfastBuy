<?php

namespace App\Services;

use App\Models\Condominia;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CondominiaServices
{
    public function getAllCond()
    {
        // $respon = Role::where('name', 'Responsavel')->value('id');
        // return DB::table('condominias')
        //     // ->join('accounts', 'condominias.id', '=', 'accounts.condominia_id')
        //     ->join('users', 'accounts.user_id', '=', 'users.id')

        //     ->select(
        //         'condominias.id',
        //         'condominias.name',
        //         'condominias.contract_condominias_id as cond_id',
        //         'condominias.address_condominias_id as addr_id',
        //         'users.email as responsable_email'
        //     )
        //     ->groupBy(
        //         'condominias.id',
        //         'condominias.name',
        //         'users.email',
        //         'condominias.contract_condominias_id',
        //         'condominias.address_condominias_id',
        //         'users.email')
        // ->get();
        return Condominia::with(['address', 'contract', 'responsable'])->get();
    }

    public function getlinkToUser()
    {
        $auth = auth()->user();
        // dd($auth->account)
        return DB::table('condominias')->where('id', $auth->account->condominia->id)->get();
    }

    public function createCondominia(String $name) :Condominia
    {
        $cond = new Condominia();
        $cond->name = $name;
        $cond->saveOrFail();
        return $cond;
    }
    public function updateResponsable(int $condominia,int $responsable_id)
    {
        $cond = Condominia::find($condominia);
        $cond->update(['responsable_id'=> $responsable_id]);
        // dd($cond);
    }
    public function getOne(Condominia $condominia)
    {
        return $condominia->where('id', $condominia->id)->with(['contract', 'address'])->first();
    }
}
