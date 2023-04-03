<?php

namespace App\Http\Controllers;

use App\DataTransferObject\Product\ProductDTO;
use App\Helpers\FileHelper;
use App\Http\Requests\ValidateRequest;
use App\Models\Product;
use App\Services\ProductsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ValidateRequest;
    private $loggedUser;
    private $permisions;
    private ProductsServices $productService;
    public function __construct( ProductsServices $productService)
    {
        $this->middleware('auth:api')->except(['index']);
        $this->loggedUser = auth()->user();
        $this->permisions = (Array)["M", "V"];
        $this->productService = $productService;
    }
    /**
     *  returns all records
     * @param  \App\Models\Product  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        $list = Cache::remember('products', 120, function(){
            return Product::with(['category', 'condominia'])->get();
        });

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
    public function created(Request $request, FileHelper $file)
    {
        $dto = new ProductDTO(...$request->only([
            'name',
            'barcode',
            'quantity',
            'value',
            'category_id',
            'type',
            'description',
            'condominia_id'
        ]));
        $url = null;
        if($request['image_one']){
            $url = $file->createdImageProduct($dto->barcode, $request['image_one']);
        }

        if(in_array($this->loggedUser->type, $this->permisions)){

            $register = $this->productService->createProduct($dto, $url);

            if($register){
                return $this->longAnswer('success','Sucesso produto adicionado!',['product'=>$register],201);
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
    public function update(Request $request, Product $product, FileHelper $file)
    {
        $request['id'] = $product->id;

        $dto = new ProductDTO(...$request->only([
            'name',
            'barcode',
            'quantity',
            'value',
            'category_id',
            'type',
            'description',
            'id',
            'condominia_id'
        ]));

        if(in_array($this->loggedUser->type, $this->permisions)){

            if($product){
                $url = null;
                if($request['image_one']){
                    if($product->image_one){
                        Storage::disk('public')->delete($product->image_one);
                    }
                    $url = $file->createdImageProduct($dto->barcode, $request['image_one']);
                }
                $register = $this->productService->updateProduct($dto, $product->id, $url);

                if($register){

                    return $this->longAnswer('success', 'Produto alterado com sucesso!',['produtos'=> $register], 200 );
                }
                return $this->simpleAnswer('error', 'Erro inesperado!', 500);
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
