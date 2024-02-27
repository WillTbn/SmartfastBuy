<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Services\CondominiaServices;
use App\Services\InvitationServices;
use Illuminate\Http\Request;
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
    public function create(Request $request)
    {
        return $request;
    }
}
