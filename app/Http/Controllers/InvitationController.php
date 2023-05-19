<?php

namespace App\Http\Controllers;

use App\DataTransferObject\Invitation\InvitationDTO;
use App\DataTransferObject\Invitation\InvitationUpdateDTO;
use App\Http\Requests\ValidateRequest;
use App\Jobs\Invitation\UpdateInvitationJob;
use App\Jobs\Invitation\SendEmailInvitationJob;
use App\Jobs\Invitation\SendUpdateInvitationJob;
use App\Jobs\Invitation\StoreInvitationJob;
use App\Models\Invitation;
use App\Services\InvitationServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class InvitationController extends Controller
{
    use ValidateRequest;
    private $permissions;
    private $loggedUser;
    private $invServices;
    public function __construct(
        protected InvitationServices $invitationServices
    )
    {
        $this->permissions = (Array)["M","V"];
        $this->loggedUser = auth()->user();
        $this->invServices = $invitationServices;
    }
    public function getAll()
    {

        $inv = $this->invServices->getDataAll();
        return $this->longAnswer('success', 'Segue dados encontrados!', ['invite'=>$inv], 200);

    }
    public function get(Invitation $invitation, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => [
                'required',
                Rule::exists('invitations')->where('id', $invitation->id)
            ]
        ], $this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 402);
        }

        if($invitation){

            $invi = $this->invServices->getData($invitation->id);
            return $this->longAnswer('success', 'Segue dados encontrados!', ['invite'=>$invi], 200);
        }

        return $this->simpleAnswer('error', 'Não há convite!', 401);


    }
    public function sendInvite(Request $request)
    {
        $dto = new InvitationDTO(...$request->only([
            'name',
            'email',
            'data'
        ]));

        if(in_array($this->loggedUser->type, $this->permissions)){
            (StoreInvitationJob::dispatch($dto))->delay(2);
            (SendEmailInvitationJob::dispatch($dto))->delay(7);

            // StoreInvitationJob::withChain([
            //     new SendEmailInvitationJob($dto)
            // ])->dispatch($dto);

            return $this->simpleAnswer('success', 'Convite enviado com sucesso!', 200);

        }
        return $this->simpleAnswer('error', 'Não tem permissão para tal!', 401);

    }
    public function updateInvitation(Invitation $invitation, Request $request)
    {
        $request['id'] =  $invitation->id;
        $dto = new InvitationUpdateDTO(...$request->only([
            'id',
            'email',
            'name',
            'data'
        ]));
        if($invitation){
            if(in_array($this->loggedUser->type, $this->permissions)){
                UpdateInvitationJob::dispatch($dto);
                (SendUpdateInvitationJob::dispatch($dto))->delay(7);
                return $this->simpleAnswer('success', 'Convite re-enviado com sucesso!', 200);
            }
            return $this->simpleAnswer('error', 'Não tem permissão para tal!', 401);
        }
        return $this->simpleAnswer('error', 'Convite não existente!', 401);
    }
}
