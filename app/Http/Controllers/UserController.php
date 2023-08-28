<?php

namespace App\Http\Controllers;

use App\DataTransferObject\User\UserAdmDTO;
use App\Jobs\AdmSystem\Account\AccountCreateJob;
use App\Jobs\AdmSystem\Account\AccountDeleteJob;
use App\Jobs\AdmSystem\Invitation\SendEmailWelcomeJob;
use App\Models\User;
use App\Services\Adm\AccountServices;
use App\Services\Adm\UserServices;
use App\Services\RoleServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private RoleServices $role;
    private UserServices $userservice;
    private AccountServices $accountservice;
    public function __construct(
        RoleServices $role,
        UserServices $userservice,
        AccountServices $accountservice
    )
    {
        $this->role = $role;
        $this->userservice = $userservice;
        $this->accountservice = $accountservice;
    }

    public function index(){
        // $user = User::paginate(5);
        return Inertia::render('Users/ListUsers', [
            'roles' => [...$this->role->getRoles()],
            'users' => [...$this->userservice->getAllUsers()]
            // 'users' => $user
        ]);
    }
    public function create(Request $request)
    {
        $dto = new UserAdmDTO(...$request->only([
            'name',
            'password',
            'password_confirmation',
            'email',
            'role_id',
            'person',
            'genre',
            'birthday',
            'notifications',
            'phone',
            'telephone'
        ]));
        // return $dto;

        AccountCreateJob::withChain([
            new SendEmailWelcomeJob($dto)
        ])->dispatch($dto, $this->userservice, $this->accountservice);

        return redirect()->back()
        ->with('success', 'Novo usuário criado com sucesso, e-mail com senha para ele será enviado!');
    }
    public function deleted($id)
    {
        AccountDeleteJob::dispatch( $id, $this->userservice, $this->accountservice);
        return redirect()->back()
        ->with('success', 'Usuário deletedo com sucesso!');
    }
}
