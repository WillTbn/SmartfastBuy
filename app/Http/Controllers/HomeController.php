<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\InvitationServices;
use App\Services\ProductsServices;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    private ProductsServices $productService;
    private InvitationServices $invites;
    public function __construct(
        ProductsServices $productService,
        InvitationServices $invites
    ) {
        $this->productService = $productService;
        $this->invites = $invites;
    }

    public function index(){

        return Inertia::render('Dashboard', [
            'itens' =>[
                [...$this->productService->countProducts()],
                [...$this->invites->countInvitations()],
            ]
        ]);
    }
}
