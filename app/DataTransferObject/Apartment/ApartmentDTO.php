<?php

namespace App\DataTransferObject\Apartment;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;

class ApartmentDTO extends AbstractDTO implements InterfaceDTO
{
    public function __construct(
        public readonly string $block_id,
        public readonly int $number,
        public readonly int $condominia_id,
    )
    {
        $this->validate();
    }
    public function rules():array
    {
        return [
            'block_id' =>  'required|exists:blocks,id',
            'number' => 'required|min:2',
            'condominia_id' => 'exists:condominias,id',
        ];;
    }
    public function messages():array
    {
        return [
            'required' => 'O :attribute é obrigatório!',
            'min' => 'É necessário no mínimo :min caracteres no campo :attribute!',

        ];
    }
    public function validator():Validator
    {
        return Validator($this->toArray(), $this->rules(), $this->messages());
    }
    public function validate():array
    {
        return $this->validator()->validate();
    }
}
