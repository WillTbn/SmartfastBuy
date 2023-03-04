<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function index(Product $product)
    {
        $list = $product->with(['category'])->get();

        if($list)
        {
            return $this->longAnswer('success', 'Lista de produtos!',['produtos'=> $list], 200 );
        }
        return $this->simpleAnswer('success', 'Lista de produtos vazia!', 200);

    }
}
