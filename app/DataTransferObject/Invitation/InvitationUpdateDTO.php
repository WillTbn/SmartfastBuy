<?php

namespace App\DataTransferObject\Invitation;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;

class InvitationUpdateDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly string $token;
    public readonly string $user_id;
    public function __construct(
        public readonly string $email,
        public readonly string $id,
        public readonly string $name,
        public readonly string $data,
    )
    {
        $this->token = Str::random(40);
        $this->user_id  = auth()->user()->id;
        $this->validate();
    }
    public function rules():array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:40|min:3',
            'email' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'email.required' =>  'E-mail já recebeu um convite.'
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
