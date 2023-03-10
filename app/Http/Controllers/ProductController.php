<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    private $permisions;
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
        $this->loggedUser = auth()->user();
        $this->permisions = (Array)["M", "V"];
    }
    /**
     *  returns all records
     * @param  \App\Models\Product  $user
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
    /**
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'barcode' => 'required|unique:products',
            'quantity' => 'required',
            'value' => 'required',
            'category_id'=> 'required|numeric',
            'type' => '',
            'description' => ''
        ],$this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){
            $register = $product->create([
                'name' =>$request->name,
                'barcode' => $request->barcode,
                'quantity' => $request->quantity,
                'value' => $request->value,
                'account_id' => $this->loggedUser->id,
                'category_id' => $request->category_id,
                'type' => $request->type,
                'description' => $request->description
            ]);
            if($register){
                return $this->longAnswer('success', 'Sucesso produto adicionado!',['product'=>$register], 200);
            }
            return $this->simpleAnswer('error', 'Error ao adicionar item.', 500);
        }
        return $this->simpleAnswer('error', 'Permissão negada!', 403);
    }
    /**
     *  return one records
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getProduct(Product $product)
    {
        $get = Product::with(['category','account'])->find($product->id);
        if($get){
            return $this->longAnswer('success', 'Produto encontrado!',['produtos'=> $get], 200 );
        }
        return $this->simpleAnswer('error', 'Não encontramos produto com esse id registrado!', 205);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'barcode' => 'required|numeric',
            'quantity' => 'required',
            'value' => 'required',
            'category_id'=> 'required|numeric',
            'type' => '',
            'description' => ''
        ], $this->message());
        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }
        $barcode = Product::where('id','!=', $product->id)->where('barcode', $request->barcode)->first();
        if($barcode){
            return $this->simpleAnswer('error', 'Barra de código já está sendo utilizada!', 205);
        }
        if(in_array($this->loggedUser->type, $this->permisions)){

            $register = Product::with(['category', 'account'])->find($product->id);
            if($register){
                $register->name =$request->name;
                $register->barcode = $request->barcode;
                $register->quantity = $request->quantity;
                $register->value = $request->value;
                $register->account_id = $this->loggedUser->id;
                $register->category_id = $request->category_id;
                $register->type = $request->type;
                $register->description = $request->description;
                $register->save();
                return $this->longAnswer('success', 'Produto alterado com sucesso!',['produtos'=> $register], 200 );
            }

            return $this->simpleAnswer('error', 'Produto não existente!', 404);
        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);

    }
    /**
     * Delete the specified resource in storage.
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return $this->simpleAnswer('success', 'Produto deletado com sucesso!', 204 );
    }
    /**
     * List of items in the recycle bin
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $product = Product::onlyTrashed()->get();

        return $this->longAnswer('success', 'Lista de Produtos que se encontram na lixeira!',['produtos'=> $product], 200 );
    }
    /**
     * Restore the specified resource in storage.
     * @param $product
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore($product)
    {
        $getProduto = Product::onlyTrashed()->where(['id' =>  $product])->first();
        if($getProduto){
            $getProduto->restore();
            return $this->longAnswer('success', 'Produto foi retirado da lixeira e estara disponível!',['produto'=> $getProduto], 200 );
        }
        return $this->simpleAnswer('error', 'Produto de identificador '.$product.' não encontrado na lixeira!', 404);
    }
    /**
     * Permanent deletion the specified resource in storage.
     * @param $product
     * @return \Illuminate\Http\Response
     */
    public Function deleteForce($product)
    {
        // return $product;
        Product::onlyTrashed()->where(['id'=> $product])->forceDelete();

        return $this->simpleAnswer('success', 'Produto deletado com sucesso!', 200);
    }

}
