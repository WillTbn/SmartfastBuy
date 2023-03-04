<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Condominia;
use Illuminate\Http\Request;

class CondominiaController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    /**
     *  returns all records
     * @return \Illuminate\Http\Response
     */
    public function index(Condominia $condominia)
    {
        if($this->loggedUser->type !== null){
            return $condominia->all();
        }
        return $this->simpleAnswer('error', 'Permissão negada.', 4000);
    }

}
