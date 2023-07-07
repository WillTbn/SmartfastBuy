<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AdminLoginController extends Controller
{
    public function index(){
        $user = 'Will Smith';
        return Inertia::render('Home', [
            'user' => $user
        ]);
    }
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }
    public function auth(Request $request)
    {
        return dd($request->all());
    }
}
