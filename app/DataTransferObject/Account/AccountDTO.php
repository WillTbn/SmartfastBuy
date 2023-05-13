<?php

namespace App\DataTransferObject\Account;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class AccountDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly int $user_id;
    public function __construct(
        public readonly string $name,
        public readonly int $person,
        public readonly string $genre,
        public readonly string $birthday,
        public readonly string $notifications,
        public readonly ?string $phone,
        public readonly ?string $telephone,
        public readonly ?int $apartment_id,
    )
    {
        $this->user_id = auth()->user()->id;

        $this->validate();

    }
    public function rules():array
    {
        return [
            'name' =>  'required|min:4|max:40',
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required|max:1',
            'person' => [
                'required','min','max:11',
                Rule::unique('accounts')->ignore(auth()->user()->id, 'user_id')
            ],
            'telephone' => 'min:10|max:11',
            'phone'=>'',
            'apartment_id' => 'exists:apartments'
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
            ''
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
