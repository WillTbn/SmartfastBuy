<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apartment\ApartmentPostRequest;
use App\Models\Apartment;
use App\Services\Adm\BlockServices;
use App\Services\ApartmentServices;


class ApartmentController extends Controller
{
    public $loggedUser;
    public $aptoServices;
    public $blockServices;
    public function __construct(
        ApartmentServices $aptoServices,
        BlockServices $blockServices
    )
    {
        $this->loggedUser = auth()->user();
        $this->aptoServices = $aptoServices;
        $this->blockServices = $blockServices;
    }
    public function index()
    {

    }

    public function created(ApartmentPostRequest $request)
    {
        $block = $this->blockServices->getOne($request->block_id);
        $result = $this->aptoServices->sendCreate($block->id, $request->number, $request->condominia_id, $request->floor);

        if($result){
            return redirect()->back()->with('success', 'Apartamento criado com sucesso!')->with('apto', $result);
        }
        return redirect()->back('500')
        ->with('error', 'Problema ao salva no banco contate o suporte!');
    }
    public function delete(Apartment $apto)
    {
        $apto->delete();
        return redirect()->back()
        ->with('success', 'Apartmento deletedo com sucesso!');
    }
}
