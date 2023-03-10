<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $list = $category->with(['products'])->get();
        // $list = $category->get();

        if($list){
            return $this->longAnswer('success', 'Lista de Categoria!',['category'=> $list], 200 );
        }
        return $this->simpleAnswer('success', 'Lista de categoria vazia!', 200);

    }
    /**
     *  returns all records without the products
     * @return \Illuminate\Http\Response
     */
    public function getList(Category $category)
    {
        $list = $category->get();

        if($list){
            return $this->longAnswer('success', 'Lista de Categoria!',['category'=> $list], 200 );
        }
        return $this->simpleAnswer('success', 'Lista de categoria vazia!', 200);
    }
    /**
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function created(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], $this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }

        if(in_array($this->loggedUser->type, $this->permisions)){
            $register = $category->create([
                'name' => $request->name
            ]);

            if($register){
                return $this->longAnswer('succes','Sucesso, categoria criada!', ['category'=>$register], 200);
            }
            return $this->simpleAnswer('error', 'Erro ao cria categoria!', 500);

        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);


    }
     /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], $this->message());

        if($validator->fails()){
            return $this->simpleAnswer('error', $validator->errors()->first(), 400);
        }

        if(in_array($this->loggedUser->type, $this->permisions)){
            // return $category;
            $register = Category::find($category->id);
            $register->name = $request->name;
            $register->touch();
            $register->save();
            if($register){
                return $this->longAnswer('success','Sucesso, categoria atualizada!', ['category'=>$register], 200);
            }
            return $this->simpleAnswer('error', 'Erro ao cria categoria!', 500);

        }

        return $this->simpleAnswer('error', 'Permissão negada!', 403);
    }

    /**
     * Delete the specified resource in storage.
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return $this->simpleAnswer('success', 'Categoria deletada com sucesso!', 204);
    }
}
