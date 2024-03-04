<?php

namespace App\Http\Controllers\Adm;

use App\DataTransferObject\Invitation\InvitationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invitation\InvitationPostRequest;
use App\Jobs\AdmSystem\SendEmailInvatationJob;
use App\Models\Invitation;
use App\Services\CondominiaServices;
use App\Services\InvitationServices;
use Inertia\Inertia;

class InvitationController extends Controller
{
    private $invServices;
    private $condServices;
    public function __construct(
        protected InvitationServices $invitationServices,
        protected CondominiaServices $condominiaServices
    )
    {
       $this->invServices = $invitationServices;
       $this->condServices = $condominiaServices;
    }

    public function index()
    {
        $inv = $this->invServices->getDataAll();
        return Inertia::render('Invitations/ListInvit', [
            'invites' => $inv,
            'condominias' => $this->condServices->getAllCond(),
        ]);
    }
    public function create(InvitationPostRequest $request)
    {
        $dto = new InvitationDTO(...$request->only([
            'email',
            'name',
            'person',
            'birthday',
            'apartment_id',
        ]));

        $response = $this->invitationServices->sendCreate($dto);

        if($response){
            SendEmailInvatationJob::dispatch($response)->delay(2);
            return redirect()->back()->with('success', 'Convite enviado com sucesso!');
        }
        return redirect()->back('500')
        ->with('error', 'Problema ao salva, entre em contato com o suporte!');

    }
    public function resend(Invitation $invitation)
    {
        if($invitation){
            $invitation->update(['updated_at' => now()]);
            return redirect()->back()->with('success', 'Convite reenviado com sucesso!');
        }

        return redirect()->back('500')
        ->with('error', 'Convite esta com algum error, relate ao suporte!');
    }
    public function delete(Invitation $invitation)
    {
        if($invitation){
            $invitation->delete();
            return redirect()->back()->with('success', 'Convite excluido!');
        }

        return redirect()->back('500')
        ->with('error', 'Convite esta com algum error, relate ao suporte!');
    }
}
