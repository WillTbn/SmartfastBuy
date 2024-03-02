<?php

namespace App\DataTransferObject\Invitation;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use App\Models\AccountClient;
use App\Models\Client;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InvitationDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly string $token;
    public readonly string $user_id;
    public readonly ?int $id;
    public readonly ?string $data;
    // public string $sendData;
    public function __construct(
        public readonly string $email,
        public readonly string $name,
        public readonly string $person,
        public readonly string $birthday,
        public readonly string $apartment_id,
        ?string $data = null,
        ?string $token = null,
        ?int $id = null
    )
    {
        $this->token = $token != null ? $token : Str::random(40);
        $this->user_id  = auth()->user()->id;
        $this->id = $id;
        $this->data = json_encode([
            'person' => $this->person,
            'birthday' => $this->birthday,
            'apartment_id' => $this->apartment_id
        ]);

        // $this->sendData = implode(",", $data);

        $this->validate();
    }
    public function rules():array
    {
        return[
            'name' => 'required|string',
            'email'=> ['email', 'max:255', Rule::unique(Client::class)],
            'person' => ['max:14', Rule::unique(AccountClient::class)],
            'birthday' => 'required|date',
            'apartment_id' => 'required|exists:apartments,id'
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
