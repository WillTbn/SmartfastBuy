<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Apartment\FloorsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Block\BlockPostRequest;
use App\Models\Apartment;
use App\Models\Block;
use App\Services\ApartmentServices;
use App\Services\BlockServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BlockController extends Controller
{
    private ApartmentServices $aptServices;
    private BlockServices $blockServices;
    public function __construct(
        ApartmentServices $apartmentServices,
        BlockServices $blockServices
    )
    {
        $this->aptServices = $apartmentServices;
        $this->blockServices = $blockServices;
    }
    public function created(BlockPostRequest $request)
    {

        // if($validator->fails())
        // {
        //     return redirect()->back()
        //     ->with('error', $validator->errors()->first());
        // }

        $register = $this->blockServices->createdBlock($request->name, $request->condominia_id);
        if($register){
            return redirect()->back()
            ->with('success', 'Bloco criado!');
        }
        return redirect()->back('500')
        ->with('error', 'Problema ao salva no banco contate o suporte!');

    }
    public function createFloorsBlocks(Request $request)
    {
        $dto = new FloorsDTO(...$request->only([
            'block',
            'apartment_start',
            'apartment_finally',
            'block_id',
            'condomia_id'
        ]));

        if($this->aptServices->getFloors($dto)){
            return redirect()->back()
            ->with('error', 'Já existem apartamento nesse intervalo, verifique.');
            // return $this->simpleAnswer('error', 'Já existem apartamento nesse intervalo, verifique.', 500);
        }
        $dataApto = array(
            'block_id' => $dto->block_id,
            'condominia_id' => $dto->condominia_id
        );

        // ESTUDAR COLOCA ISSO EM UM JOB
            for($i= $dto->apartment_start; $i <= $dto->apartment_finally; $i++){
                $dataApto['number'] = $i;
                $this->aptServices->sendCreate($dataApto['block'], $dataApto['number'], $dataApto['condominia_id']);
            }
        // FINAL DO FUTURO JOB

        return redirect()->back()
            ->with('success', 'Sucesso, apartamentos cadastrados com sucesso.');
        // return $this->simpleAnswer('success', 'Sucesso, apartamentos cadastrados com sucesso.', 200);
    }
    public function deleted(Block $block){

        $block->delete();
        return redirect()->back()
        ->with('success', 'Usuário deletedo com sucesso!');
    }
}
