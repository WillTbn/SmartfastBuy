<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public $loggedUser;
    public function __construct()
    {
        $this->loggedUser = auth()->user();
    }
    public function index(){

    }
}
