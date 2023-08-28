<?php

namespace App\DataTransferObject\Account;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;
use InvalidArgumentException;
use Illuminate\Validation\Rule;

class AccountAdminDTO extends AbstractDTO implements interfaceDTO
{
    public function __construct(
        public readonly int $user_id,
        public readonly int $person,
        public readonly string $genre,
        public readonly string $birthday,
        public readonly string $notifications,
        public readonly ?string $phone,
        public readonly ?string $telephone
    )
    {
        // $this->user_id = auth()->user()->id;

        $this->validate();

    }
    public function rules():array
    {
        return [
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required|max:1',
            'user_id' => [
                'required',
                Rule::unique('accounts')
            ],
            'person' => [
                'required','max:11',
                Rule::unique('accounts')->ignore($this->user_id, 'user_id')
            ],
            'telephone' => 'min:10|max:11',
            'phone'=>'',
        ];
    }
    public function messages():array
    {
        return[
            'required' => 'O :attribute é obrigatório!',
            'date' => "o :attribute tem que ser uma data válida.",
            'name.min' => 'É necessário no mínimo :min caracteres no nome!',
            'string' => 'Campo :attribute só aceitar texto.',
            'password_confirm.same' => 'Senhas não conferem, campo confirma senha tem que igual ao campo senha.',
            'code.min' => 'O código de verificação tem no minimo :min caracters',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'barcode.unique' => 'Código de barra já existente em nosso banco, atualize o existente.',
            'unique' => 'o :attribute já existente.'
        ];
    }
    public function validator():Validator
    {
        return validator($this->toArray(), $this->rules(), $this->messages());
    }

    public function validate():array
    {
        return $this->validator()->validate();
    }
}
