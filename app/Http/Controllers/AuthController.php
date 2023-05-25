<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ValidateRequest;

    public function __construct()
    {
        $this->middleware('auth:api')->except(['login','register', 'unauthorized']);
    }

    public function unauthorized()
    {
        return response()->json(['error' => 'Não autorizado'],401);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ],
        $this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials, true);
        //return $token;
        if(!$token) {
            return $this->simpleAnswer('error', 'Email ou senha invalidas!', 400);
        }
        //return dd($token);
        $user = Auth::user();
        return $this->longAnswer('success', 'Usuário encontrado.', [
            'user'=>$user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 201);
    }

    public function register(Request $request, User $use)
    {
        //return $request->validated();
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirm' =>'required|same:password',
            'type'=> 'required|max:1'
        ],
        $this->message());
        if($validator->fails()){
           return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }

        $user = $use->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type
        ]);

        $token = Auth::login($user, true);
        return $this->longAnswer('success', 'Sucesso na requisição.',[
            'user'=>$user,
            'authorization'=>[
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 200);
    }
    public function validateToken()
    {
        $user = Auth::user();
        //return $user->verifield_email;exit;
        if($user){
            return $this->longAnswer('success', 'Usuario encontrado.', [
                'user'=>$user
            ], 201);
        }
        return $this->simpleAnswer('error','token invalido.', 401);
    }
    public function logout()
    {
        Auth::logout();
        return $this->simpleAnswer('succes','Desconectado com sucesso.', 200);
    }

    public function refresh()
    {
        return $this->longAnswer('success', 'Token renovado.', [
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ], 201);
    }
}
