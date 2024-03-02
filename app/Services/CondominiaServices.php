<?php

namespace App\Services;

use App\Models\Condominia;
use Illuminate\Database\Eloquent\Collection;

class CondominiaServices
{
    public function getAllCond(): Collection
    {
        return Condominia::all();
    }

    public function createCondominia(String $name) :Condominia
    {
        $cond = new Condominia();
        $cond->name = $name;
        $cond->saveOrFail();
        return $cond;
    }
}
