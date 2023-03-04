<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Apartment;

class ApartmentController extends Controller
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
    public function index(Apartment $apartment)
    {
        if($this->loggedUser->type === 'M'){
            return $apartment->with(['condominia'])->get();
        }
        return $this->simpleAnswer('error', 'Permissão negada.', 400);
    }

}
