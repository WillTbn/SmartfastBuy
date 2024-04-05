<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Contract\ContractCondominiaDTO;
use App\DataTransferObject\Responsible\ResponsibleDTO;
use App\Http\Controllers\Controller;
use App\Jobs\AdmSystem\Responsible\UserAndAccountCreateJob;
use App\Models\Condominia;
use App\Services\Adm\AccountServices;
use App\Services\Adm\ContractCondominiaServices;
use App\Services\Adm\UserServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContractCondominiaController extends Controller
{
    private UserServices $userServices;
    private AccountServices $accountServices;
    private ContractCondominiaServices $contractServices;
    public function __construct(
        UserServices $userServices,
        AccountServices $accountServices,
        ContractCondominiaServices $contractServices,
    )
    {
        $this->userServices = $userServices;
        $this->accountServices = $accountServices;
        $this->contractServices = $contractServices;
    }
    public function viewCreateContract(Condominia $condominia, Request $request)
    {
        return Inertia::render('Contract/CreatedContract', [
            'condominia' => $condominia
        ]);
    }
    public function create(Request $request)
    {

        $respDto = new ResponsibleDTO(...$request->only([
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
        // dd($request->document);
        $contractDto = new ContractCondominiaDTO(...$request->only([
            'document',
            'condominia_id',
            'initial_date',
            'final_date',
            'ceo',
            'responsible_id',
        ]));

        $this->contractServices->createdContract($respDto, $contractDto);

        return redirect()->back()
        ->with('success', 'Responsavel adicionado, e-mail com senha para ele será enviado e status do condominio atualizado!');
    }
}
