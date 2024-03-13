<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Condominia\CondominiaPostRequest;
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

        $user = $request->user();

        // dd($request->user()->isMaster());
        return Inertia::render('Condominia/ListCondominia', [
            'condominias' => $user->isMaster() ? $this->condServices->getAllCond() : $this->condServices->getlinkToUser(),
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
    public function create(CondominiaPostRequest $request)
    {
        // $register = $this->blockServices->createdBlock($request->name, $request->condominia_id);
        $register = $this->condServices->createCondominia($request->name);
        if($register){
            return redirect()->back()
            ->with('success', 'Condominio criado!');
        }
        return redirect()->back('500')
        ->with('error', 'Problema ao salva no banco contate o suporte!');
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
