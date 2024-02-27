<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Condominia;
use App\Services\ApartmentServices;
use App\Services\BlockServices;
use App\Services\CondominiaServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CondominiaController extends Controller
{
    private CondominiaServices $condServices;
    private ApartmentServices $aptServices;
    private BlockServices $blockServices;
    public function __construct(
        CondominiaServices $condomoniaServices,
        ApartmentServices $apartmentServices,
        BlockServices $blockServices,
    )
    {
        $this->condServices = $condomoniaServices;
        $this->aptServices = $apartmentServices;
        $this->blockServices = $blockServices;
    }
    public function index()
    {
        return Inertia::render('Condominia/ListCondominia', [
            'condominias' => $this->condServices->getAllCond()
        ]);
    }

    public function getOne(Condominia $condominia)
    {
        // return $condominia;
        // TEM QUE FAZER TRATATIVA SE CASO NÂO TENHA $id
        return Inertia::render('Condominia/UpdateCondominia', [
            'condominia' => $condominia,
            'apartments' => $this->aptServices->getAptCond($condominia->id),
            'blocks' => $this->blockServices->getAllBlock($condominia->id)
            // 'roles' => [...$this->role->getRoles()],
            // 'users' => [...$this->userservice->getAllUsers()]
            // 'users' => $user
        ]);
    }

}
