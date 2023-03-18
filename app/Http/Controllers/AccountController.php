<?php

namespace App\Http\Controllers;

use App\Enums\genre;
use App\Enums\notifications;
use App\Http\Requests\ValidateRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Account $account)
    {
        $validator = Validator::make($request->all(), [
            'person' => 'required|max:11|unique:accounts',
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required|max:1',
            'user_id' => 'required|unique:accounts',
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        if($request->user_id != $this->loggedUser->id){
            return $this->simpleAnswer('error', 'ID - diferente do usuário logado, alterada dados alheus não pode, contate a administração!', 400);
        }

        $register = $account->create([
            'person' => $request->person,
            'genre' => genre::from($request->genre)->getValue(),
            'birthday' => $request->birthday,
            'notifications' => notifications::from($request->notifications)->getValue(),
            'user_id' => $this->loggedUser->id,
        ]);
        return $this->longAnswer('success', 'Sucesso dados preenchidos com sucesso!',['account'=>$register], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $user = $account->with(['user'])->first();
        if($user){
            return $this->longAnswer('success', 'Usuário encontrado com sucesso!',['account'=>$user], 200);
        }
        return $this->simpleAnswer('error', 'Usuário não encontrado!', 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, Account $account)
    {
        $validator = Validator::make($request->all(), [
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required|max:1',
            'person' => [
                'required',
                Rule::unique('accounts')->ignore($this->loggedUser->id, 'user_id')
            ]
        ],$this->message());


        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        if($account->user_id != $this->loggedUser->id){
            return $this->simpleAnswer('error', 'ID - diferente do usuário logado, alterada dados alheus não pode, contate a administração!', 400);
        }

        $register = Account::find($account->id);
        if($register){
            $register->person =$request->person;
            $register->genre = genre::from($request->genre)->getValue();
            $register->birthday = $request->birthday;
            $register->notifications = notifications::from($request->notifications)->getValue();
            $register->save();
            return $this->longAnswer('success', 'Conta alterado com sucesso!',['conta'=> $register], 200 );
        }
        return $this->longAnswer('success', 'Sucesso dados preenchidos com sucesso!',['account'=>$register], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
