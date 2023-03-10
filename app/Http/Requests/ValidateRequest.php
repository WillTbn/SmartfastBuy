<?php
namespace App\Http\Requests;

trait ValidateRequest
{
    public function headerResponse()
    {
        return [
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        ];
    }
    public function unicodeJson(){
        return JSON_UNESCAPED_UNICODE;
    }
    /**
     * @param string $status qual estado da requisição success|error
     * @param string $msg qual mensagem retorna
     * @param string $status API REST
     */
    public function simpleAnswer(
        $status,
        $msg,
        $statusApi
    )
    {
        return response()->json([
            'status'=> $status,
            'message' => $msg
        ], $statusApi, $this->headerResponse(), $this->unicodeJson());
    }
    /**
     * @param string $status qual estado da requisição success|error
     * @param string $msg qual mensagem retorna
     * @param array $long resposta com valor e chave ex.: ['user' => $user, 'outracoisa'=> $outracoisa]
     * @param string $statusApi API REST
     */
    public function longAnswer(
        $status,
        $msg,
        $long,
        $statusApi
    )
    {
        $arrayempty = [];
        /*
        foreach($long as $key => $value){
            $arrayempty = $key
        }*/
        return response()->json([
            'status'=> $status,
            'message' => $msg,
            'data'=> $long,
        ], $statusApi, $this->headerResponse(), $this->unicodeJson());
    }
    public function message()
    {
        return[
            'required' => 'O :attribute é obrigatório!',
            'date' => "o :attribute tem que ser uma data válida.",
            'name.min' => 'É necessário no mínimo :min caracteres no nome!',
            'string' => 'Campo :attribute só aceitar texto.',
            'email.email' => 'Digite um email válido!',
            'email.unique' => 'Email já esta sendo usado!',
            'password_confirm.same' => 'Senhas não conferem, campo confirma senha tem que igual ao campo senha.',
            'code.min' => 'O código de verificação tem no minimo :min caracters',
            'avatar.required' => 'Uma imagem JPG, JPGE ou PNG é obrigatório.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'person.unique' => 'CPF já em uso!',
            'user_id.unique' => 'Dados já enviados!',
            'barcode.unique' => 'Código de barra já existente em nosso banco, atualize a existente.'

        ];
    }
}
