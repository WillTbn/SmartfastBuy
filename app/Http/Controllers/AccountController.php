<?php

namespace App\Http\Controllers;

use App\DataTransferObject\Account\AccountDTO;
use App\Enums\genre;
use App\Enums\notifications;
use App\Helpers\FileHelper;
use App\Http\Requests\ValidateRequest;
use App\Models\Account;
use App\Services\AccountServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    private $permissions;
    private AccountServices $accountService;
    public function __construct( AccountServices $accountService)
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
        $this->permissions = (array)["M", "V"];
        $this->accountService = $accountService;
    }
    /**
     * Pegar all com joi
     */
    public function getAll(){
        // $users = DB::table('users')
        //     ->join('posts', 'users.id', '=', 'posts.user_id')
        //     ->select('users.name', 'posts.title')
        //     ->get();

        $users = DB::table('users')
            ->join('accounts', 'users.id', '=', 'accounts.user_id')
            ->select(
                'users.email',
                'accounts.apartment_id',
                'accounts.avatar'
            )
        ->get();

        return $this->longAnswer('success', 'Sucesso dados preenchidos com sucesso!',['account'=>$users], 200);
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
    public function created(Request $request, Account $account, FileHelper $file)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|max:40',
            'person' => 'required|max:11|unique:accounts',
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required|max:1',
            'user_id' => 'required|unique:accounts',
            'apartment_id' => 'exists:apartments'
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        if($request->user_id != $this->loggedUser->id){
            return $this->simpleAnswer('error', 'ID - diferente do usuário logado, alterada dados alheus não pode, contate a administração!', 400);
        }

        $register = $account->create([
            'name' => $request->name,
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
        $user = $account->where('user_id', $this->loggedUser->id)->with(['apartment','condominia'])->first();
        // $user = $account->where('user_id', $this->loggedUser->id)->with(['user','apartment'])->first();
        // $user['codominia'] = Condominia::where('id', $user->apartment->condominia_id)->first();
        if($user){
            return $this->longAnswer('success', 'Usuário encontrado com sucesso!',['account'=>$user], 200);
        }
        return $this->simpleAnswer('error', 'Usuário não encontrado!'. $this->loggedUser->id, 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, Account $account, FileHelper $file)
    {

        $dto = new AccountDTO(...$request->only([
            'name',
            'genre',
            'birthday',
            'notifications',
            'person',
            'telephone',
            'phone',
            'apartment_id'
        ]));

        if(!$account){
            return $this->simpleAnswer('error', 'Conta não identificada.', 404);
        }

        if(!in_array($this->loggedUser->type, $this->permissions) && $this->loggedUser->id != $account->user_id){
            return $this->simpleAnswer('error', 'ID - diferente do usuário logado, alterada dados alheus não pode, contate a administração!', 400);
        }

        $url = null;
        if($request['avatar']){
            if($account->avatar){
                Storage::disk('public')->delete($account->avatar);
            }
            $url = $file->imageAvatar($dto->user_id, $request['avatar']);
            if(!$url){
                return $this->simpleAnswer('error', 'Imagem não esta no formato aceitor, formatos aceitos JPG, PNG, JPEG', 400);
            }
        }


        $registerUpdate = $this->accountService->updateAccount($dto, $account->user_id, $url);

        if($registerUpdate){
            return $this->longAnswer('success', 'Dados atualizados!', ['account' => $registerUpdate],200);
        }

        return $this->simpleAnswer('error', 'OPS!! erro inexperado, tente novamente mais tarde!', 500);

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
