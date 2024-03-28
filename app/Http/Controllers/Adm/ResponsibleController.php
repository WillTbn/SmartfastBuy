<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\AdmSystem\Account\AccountCreateJob;
use App\Jobs\AdmSystem\Responsible\SendEmailWelcomeResponsableJob;
use App\Jobs\AdmSystem\Responsible\UserAndAccountCreateJob;
use App\Models\Role;
use App\Services\Adm\AccountServices;
use App\Services\RoleServices;
use App\Services\Adm\UserServices;
use App\Services\CondominiaServices;
use Exception;

class ResponsibleController extends Controller
{

    private UserServices $userservice;
    private AccountServices $accountservice;
    private RoleServices $roleService;
    private CondominiaServices $condService;
    public function __construct(
        UserServices $userservice,
        AccountServices $accountservice,
        RoleServices $roleService,
        CondominiaServices $condService,
    )
    {
        $this->userservice = $userservice;
        $this->accountservice = $accountservice;
        $this->roleService = $roleService;
        $this->condService = $condService;

    }
    public function create(Request $request)
    {
        // $request['role_id'] = $this->roleService->getRoleResponsibleId();
        // dd('aqui  ->'.RoleEnum::RESPONSIBLE);
        // $request['role_id'] = RoleEnum::RESPONSIBLE;
        // dd($request['role_id']);

        $dto = new ResponsibleDTO(...$request->only([
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
            'condominia_id'
        ]));

        UserAndAccountCreateJob::withChain([
            new SendEmailWelcomeResponsableJob($dto)
        ])->dispatch($dto, $this->userservice, $this->accountservice, $this->condService);

        return redirect()->back()
        ->with('success', 'Novo usuário criado com sucesso, e-mail com senha para ele será enviado!');
    }
}
