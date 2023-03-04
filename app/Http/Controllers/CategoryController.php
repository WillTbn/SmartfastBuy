<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
        $this->loggedUser = auth()->user();
    }
    /**
     *  returns all records
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $list = $category->with(['products'])->get();

        if($list){
            return $this->longAnswer('success', 'Lista de Categoria!',['category'=> $list], 200 );
        }
        return $this->simpleAnswer('success', 'Lista de categoria vazia!', 200);

    }
}
