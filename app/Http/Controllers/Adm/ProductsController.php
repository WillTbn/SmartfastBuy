<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductsController extends Controller
{
    private ProductsServices $serviceproduct;

    public function __construct(
        ProductsServices $serviceproduct,
    )
    {
        $this->serviceproduct = $serviceproduct;

    }
    public function index(Request $request)
    {
        // dd($request->user()->isMaster());
        return Inertia::render('Products/ListProducts', [
            'products' => $request->user()->isMaster()
            ? $this->serviceproduct->getAllProduct()
            : $this->serviceproduct->getAllProductCondominia($request->user()->account->condominia_id)
        ]);
    }
    public function getOne( Product $product, Request $request)
    {
        // dd($this->serviceproduct->getOne($id));
        // TEM QUE FAZER TRATATIVA SE CASO NÂO TENHA $id

        return Inertia::render('Products/UpdatedProducts', [
            'product' => $product,
            'product_one' => $this->serviceproduct->getOne($product, $request->user()->isMaster())
            // 'roles' => [...$this->role->getRoles()],
            // 'users' => [...$this->userservice->getAllUsers()]
            // 'users' => $user
        ]);
    }
    public function imageOne(Request $request,Product $product)
    {

        $validator = Validator::make($request->all(), [
            'image_one' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->file('image_one'))
        {
            $file = $request->file('image_one');
             // TIRA ISSO PARA OUTRA Fazer uma abstração CLASS or HELPER
            $filename= date('Y_m_d_H_m_s');
            $extension = $file->getClientOriginalExtension();
            $nameLast = $product->id.'/'.$filename.'.'.$extension;
             // TIRA ISSO PARA OUTRA Fazer uma abstração CLASS or HELPER
            $file->storeAs('products', $nameLast);
            $product->update(['image_one' =>$nameLast]);

        }
        return redirect()->back()->with('success', 'Imagem atualizada com sucesso!');
        // return Inertia::render('Products/UpdatedProducts', [
        //     'product' => $product,
        //     'product_one' => $this->serviceproduct->getOne($product)
        //     // 'roles' => [...$this->role->getRoles()],
        //     // 'users' => [...$this->userservice->getAllUsers()]
        //     // 'users' => $user
        // ]);
    }
    public function deleted()
    {
        return 'oi';
    }
}
