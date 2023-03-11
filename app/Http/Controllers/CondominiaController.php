<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Condominia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CondominiaController extends Controller
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
    public function index(Condominia $condominia)
    {
        if(in_array($this->loggedUser->type, $this->permisions)){
            return $condominia->with(['apartments'])->get();
        }
        return $this->simpleAnswer('error', 'Permissão negada.', 4000);
    }
    /**
     * @param  \App\Models\Condominia  $condominia
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Condominia $condominia)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Condominia::where('name', $request->name)->first();

        if($exist){
            return $this->simpleAnswer('error','Condominio já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){
            $register = $condominia->create([
                'name' =>$request->name
            ]);
            if($register){
                return $this->longAnswer('success', 'Condominio adicionado!',['condominio'=>$register], 200);
            }
            return $this->simpleAnswer('error', 'Error ao adicionar condominio.', 500);
        }
        return $this->simpleAnswer('error', 'Permissão negada!', 403);
    }
    /**
     *  return one records
     * @param  \App\Models\Condominia  $condominia
     * @return \Illuminate\Http\Response
     */
    public function getCondominia(Condominia $condominia)
    {
        // $get = Condominia::find($condominia->id);
        if($condominia){
            return $this->longAnswer('success', 'Condominio encontrado!',['condominio'=> $condominia], 200 );
        }
        return $this->simpleAnswer('error', 'Não encontramos condominio com esse id registrado!', 205);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Condominia  $condominia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condominia $condominia)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ],$this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $exist = Condominia::where('id', '!=', $request->id)->where('name', $request->name)->first();

        if($exist){
            return $this->simpleAnswer('error','Condominio já cadastrado!', 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){

            $register = Condominia::find($condominia->id);
            if($register){
                $register->name =$request->name;
                $register->touch();
                $register->save();
                return $this->longAnswer('success', 'Condominio alterado com sucesso!',['condominio'=> $register], 200 );
            }

            return $this->simpleAnswer('error', 'Condominio não existente!', 404);
        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);

    }

    /**
     * Delete the specified resource in storage.
     * @param  \App\Models\Condominia  $condominio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condominia $condominio)
    {
        Condominia::destroy($condominio->id);

        return $this->simpleAnswer('success', 'Condominio deletado com sucesso!', 200 );
    }

}
