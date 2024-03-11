<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Responsable\ResponsableDTO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\AdmSystem\Account\AccountCreateJob;
use App\Jobs\AdmSystem\Responsable\SendEmailWelcomeResponsableJob;
use App\Jobs\AdmSystem\Responsable\UserAndAccountCreateJob;
use App\Models\Role;
use App\Services\Adm\AccountServices;
use App\Services\RoleServices;
use App\Services\Adm\UserServices;
use Exception;

class ResponsableController extends Controller
{

    private UserServices $userservice;
    private AccountServices $accountservice;
    private RoleServices $roleService;
    public function __construct(
        UserServices $userservice,
        AccountServices $accountservice,
        RoleServices $roleService
    )
    {
        $this->userservice = $userservice;
        $this->accountservice = $accountservice;
        $this->roleService = $roleService;
    }
    public function create(Request $request)
    {
        $request['role_id'] = $this->roleService->getRoleResponsableId();
        // dd('aqui  ->'.$request['role_id']);
        $dto = new ResponsableDTO(...$request->only([
            'name',
            'password',
            'password_confirmation',
            'email',
            'person',
            'genre',
            'birthday',
            'notifications',
            'phone',
            'telephone',
            'condominia_id',
            'role_id'
        ]));

        UserAndAccountCreateJob::withChain([
            new SendEmailWelcomeResponsableJob($dto)
        ])->dispatch($dto, $this->userservice, $this->accountservice);

        return redirect()->back()
        ->with('success', 'Novo usuário criado com sucesso, e-mail com senha para ele será enviado!');

        dd($dto);
    }
}
