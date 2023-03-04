<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function index(User $user)
    {
        $list = $user->where('id', '!=', $this->loggedUser->id)->get();

        if(count($list) > 0){
            return $this->longAnswer('success', 'Lista de usuários!',['users'=> $list], 200 );
        }
        return $this->simpleAnswer('success', 'Lista de usuários vazia!', 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $use
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, User $use)
    {
        if($this->loggedUser->type != null){

            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'password_confirm' =>'required|same:password',
                'type' => 'required|max:1'
            ],
            $this->message());
            if($validator->fails()){
               return $this->simpleAnswer('error', $validator->errors()->first(), 400);
            }
            //return $request;
            $user = $use->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type,
            ]);

            return $this->longAnswer('success', 'Usuário Criado com sucesso!',[
                'user'=>$user,
            ], 200);
        }
        return $this->simpleAnswer('error','Não tem permissão!', 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'password_confirm' =>'required|same:password',
            'type' => 'required|max:1'
        ], $this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){
            $int = (int)$request->id;

            $email = User::where('id','!=', $int)->where('email', $request->email)->first();
            if($email){
                return $this->simpleAnswer('error', 'Email já esta sendo utilizado!', 205);
            }

            $user = User::find($int);
            // verificando se email passado já existe
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->type = $request->type;
                $user->save();

                return $this->longAnswer('success', 'Usuário atualizado com sucesso!', ['user'=>$user], 200);
            }

            return $this->simpleAnswer('error', 'Usuário não existente!', 404);
        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);

    }
}
