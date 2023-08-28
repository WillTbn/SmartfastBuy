<?php
namespace App\DataTransferObject\User;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules;

class UserDTO extends AbstractDTO implements InterfaceDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $password_confirmation,
        public readonly int $role_id,
    )
    {
        $this->validate();
    }
    public function rules():array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults() ]
        ];
    }
    public function messages():array
    {
        return [
            'required.name' => "Obrigatório campo name",
            'required.email' => "Obrigatório campo e-mail",
            'unique' => ':attribute ja registrado em no nosso sistema.',
            'min' => ':attribute tem que ter no minimo :min.',
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
