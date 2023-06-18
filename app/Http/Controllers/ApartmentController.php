<?php

namespace App\Http\Controllers;

use App\Services\ApartmentServices;
use App\DataTransferObject\Apartment\ApartmentDTO;
use App\DataTransferObject\Apartment\FloorsDTO;
use App\Http\Requests\ValidateRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{

    use ValidateRequest;
    private $loggedUser;
    private $permisions;
    private ApartmentServices $apto;
    public function __construct(
        ApartmentServices $aptService
    )
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
        $this->permisions = (Array)["M", "V"];
        $this->apto = $aptService;
    }

    /**
     *  returns all records
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        if(in_array($this->loggedUser->type, $this->permisions)){
            return $apartment->with(['condominia', 'block'])->get();
            // return $apartment->with(['block.condominia'])->get();
        }
        return $this->simpleAnswer('error', 'Permissão negada.', 400);
    }
    public function createdBlock(Request $request, Apartment $apartment)
    {
        $dto = new FloorsDTO(...$request->only([
            'block',
            'apartment_start',
            'apartment_finally',
            'block_id',
            'condomia_id'
        ]));

        if($this->apto->getFloors($dto)){
            return $this->simpleAnswer('error', 'Já existem apartamento nesse intervalo, verifique.', 500);
        }
        $dataApto = array(
            'block_id' => $dto->block_id,
            'condominia_id' => $dto->condominia_id
        );

        // ESTUDAR COLOCA ISSO EM UM JOB
            for($i= $dto->apartment_start; $i <= $dto->apartment_finally; $i++){
                $dataApto['number'] = $i;
                $this->apto->sendCreate($dataApto['block'], $dataApto['number'], $dataApto['condominia_id']);
            }
        // FINAL DO FUTURO JOB

        return $this->simpleAnswer('success', 'Sucesso, apartamentos cadastrados com sucesso.', 200);
    }
    /**
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Apartment $apartment)
    {
        $validator = Validator::make($request->all(), [
            'block_id'=> 'required',
            'number' => 'required',
            'condominia_id' => 'required'
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Apartment::where('block_id', $request->block_id)->where('number', $request->number)->first();

        if($exist){
            return $this->simpleAnswer('error','Apartamento já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){
            $register = $apartment->create([
                'block_id' =>$request->block_id,
                'number' => $request->number,
                'condominia_id' => $request->condominia_id
            ]);
            if($register){
                return $this->longAnswer('success', 'Apartamento adicionado!',['apartamento'=>$register], 200);
            }
            return $this->simpleAnswer('error', 'Error ao adicionar Apatarmento.', 500);
        }
        return $this->simpleAnswer('error', 'Permissão negada!', 403);
    }
    /**
     *  return one records
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function getApartment(Apartment $apartment)
    {
        $get = Apartment::with(['condominia'])->find($apartment->id);
        if($get){
            return $this->longAnswer('success', 'Apartamento encontrado!',['apartamento'=> $get], 200 );
        }
        return $this->simpleAnswer('error', 'Não encontramos apartamento com esse id registrado!', 205);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $validator = Validator::make($request->all(), [
            'block_id'=> 'required',
            'number' => 'required',
            'condominia_id' => 'required'
        ],$this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Apartment::where('block_id', $request->block_id)->where('number', $request->number)->first();

        if($exist){
            return $this->simpleAnswer('error','Apartamento já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){

            $register = Apartment::with(['condominia'])->find($apartment->id);
            if($register){
                $register->number =$request->number;
                $register->block_id = $request->block_id;
                $register->condominia_id = $request->condominia_id;
                $register->touch();
                $register->save();
                return $this->longAnswer('success', 'Apartamento alterado com sucesso!',['apartamento'=> $register], 200 );
            }

            return $this->simpleAnswer('error', 'Apartamento não existente!', 404);
        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);

    }

    /**
     * Delete the specified resource in storage.
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        Apartment::destroy($apartment->id);

        return $this->simpleAnswer('success', 'Apartamento deletado com sucesso!', 200 );
    }
}
