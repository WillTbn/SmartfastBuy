<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductsServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductsController extends Controller
{
    private ProductsServices $serviceproduct;
    public function __construct(
        ProductsServices $serviceproduct
    )
    {
        $this->serviceproduct = $serviceproduct;
    }
    public function index()
    {
        return Inertia::render('Products/ListProducts', [
            'products' => $this->serviceproduct->getAllProduct()
            // 'roles' => [...$this->role->getRoles()],
            // 'users' => [...$this->userservice->getAllUsers()]
            // 'users' => $user
        ]);
    }
    public function getOne( Product $id)
    {
        // TEM QUE FAZER TRATATIVA SE CASO NÂO TENHA $id
        return Inertia::render('Products/UpdatedProducts', [
            'product' => $id
            // 'roles' => [...$this->role->getRoles()],
            // 'users' => [...$this->userservice->getAllUsers()]
            // 'users' => $user
        ]);
    }
    public function deleted()
    {
        return 'oi';
    }
}
