<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{

    use ValidateRequest;
    private $loggedUser;
    private $permisions;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
        $this->permisions = (Array)["M", "V"];
    }

    /**
     *  returns all records
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        if(in_array($this->loggedUser->type, $this->permisions)){
            return $apartment->with(['condominia'])->get();
        }
        return $this->simpleAnswer('error', 'Permissão negada.', 400);
    }
    /**
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Apartment $apartment)
    {
        $validator = Validator::make($request->all(), [
            'block'=> 'required',
            'number' => 'required',
            'condominia_id' => 'required'
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Apartment::where('block', $request->block)->where('number', $request->number)->first();

        if($exist){
            return $this->simpleAnswer('error','Apartamento já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){
            $register = $apartment->create([
                'block' =>$request->block,
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
            'block'=> 'required',
            'number' => 'required',
            'condominia_id' => 'required'
        ],$this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Apartment::where('block', $request->block)->where('number', $request->number)->first();

        if($exist){
            return $this->simpleAnswer('error','Apartamento já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){

            $register = Apartment::with(['condominia'])->find($apartment->id);
            if($register){
                $register->number =$request->number;
                $register->block = $request->block;
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
