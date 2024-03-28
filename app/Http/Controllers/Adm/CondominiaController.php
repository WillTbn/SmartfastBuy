<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Condominia\CondominiaDTO;
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
    public function index(Request $request)
    {

        return Inertia::render('Condominia/ListCondominia', [
            'condominias' => $request->user()->isMaster() ? $this->condServices->getAllCond() : $this->condServices->getlinkToUser(),
        ]);
    }

    public function getOne(Condominia $condominia)
    {
        return Inertia::render('Condominia/UpdateCondominia', [
            'condominia' => $condominia,
            'apartments' => $this->aptServices->getAptCond($condominia->id),
            'blocks' => $this->blockServices->getAllBlock($condominia->id)

        ]);
    }
    public function storeOne(Condominia $condominia)
    {
        // $getOne = $this->condServices->getOne($condominia);
        // dd($getOne->contract);
        return Inertia::render('Condominia/EditCondominia', [
            'condominia' => $condominia,
        ]);
    }
    public function storeAddress(Condominia $condominia)
    {
        // $getOne = $this->condServices->getOne($condominia);
        // dd($getOne->contract);
        return Inertia::render('Condominia/AddAddress', [
            'condominia' => $condominia,
        ]);
    }
    public function create(Request $request)
    {

        $dtoCondominia = new CondominiaDTO(...$request->only([
            'name',
            'road',
            'state',
            'district',
            'zip_code',
            'city',
            'number',
            'document_name',
            'initial_date',
            'final_date',
        ]));
        // $register = $this->blockServices->createdBlock($request->name, $request->condominia_id);
        $this->condServices->createCondominia($dtoCondominia);

        return redirect()->back()
        ->with('success', 'Condominio criado!');
    }
    public function delete(Condominia $condominia)
    {
        return $condominia;
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
