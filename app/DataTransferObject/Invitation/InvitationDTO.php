<?php

namespace App\DataTransferObject\Invitation;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InvitationDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly string $token;
    public readonly string $user_id;
    public readonly ?int $id;
    // public string $sendData;
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly string $data,
        ?string $token = null,
        ?int $id = null
    )
    {
        $this->token = $token != null ? $token : Str::random(40);
        $this->user_id  = auth()->user()->id;
        $this->id = $id;
        // $this->sendData = implode(",", $data);

        $this->validate();
    }
    public function rules():array
    {
        return[
            'name' => 'required|min:2',
            'email' => [
                'required','email','max:255','unique:users',
                Rule::unique('invitations')->ignore($this->id)
            ],
            'data' => 'required'
        ];
    }
    public function messages():array
    {
        return[
            'required' => 'O :attribute é obrigatório!',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'email.required' =>  'E-mail já recebeu um convite.',
            'unique' =>  ':attribute já utilizado.',
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
