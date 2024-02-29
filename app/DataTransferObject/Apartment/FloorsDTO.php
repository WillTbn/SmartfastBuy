<?php

namespace App\DataTransferObject\Apartment;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;

class FloorsDTO extends AbstractDTO implements InterfaceDTO
{
    public function __construct(
        public readonly int $apartment_start,
        public readonly int $apartment_finally,
        public readonly int $block_id,
        public readonly int $condominia_id,
    )
    {
        $this->validate();
    }
    public function rules():array
    {
        return [
            'apartment_start' => 'required',
            'apartment_finally' => 'required',
            // 'condominia_id' => 'required',
            'block_id' => 'required|exists:blocks,id',
            // 'number' => 'required|min:2',
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
