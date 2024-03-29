<?php
namespace App\DataTransferObject\Condominia;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;

class CondominiaDTO extends AbstractDTO implements InterfaceDTO
{
    public function __construct(
        // date condominia
        public readonly string $name,

        // date address condominia
        public readonly ?string $road= null,
        public readonly ?string $state= null,
        public readonly ?string $district= null,
        public readonly ?string $zip_code= null,
        public readonly ?string $city= null,
        public  ?int $number = null,

        // date contract condominia
        public ?string $document_name= null,
        public ?string $initial_date= null,
        public ?string $final_date= null,

    )
    {
        $this->validate();
    }
    public function rules():array
    {
        return [
            'name' => 'required|string|max:30|unique:condominias,name',
            // 'condominia_id' => 'required|integer|unique:'.AddressCondominia::class,
            'road' => 'required|string',
            'state' => 'required|string',
            'district' => 'required|string',
            'zip_code' => 'required|string',
            'city' => 'required|string',
        ];
    }
    public function messages():array
    {
        return [
            'required' => "Obrigatório campo :attribute ",
            'unique' => ':attribute ja registrado em no nosso sistema.',
            'min' => ':attribute tem que ter no minimo :min.',
            'date' => "o :attribute tem que ser uma data válida.",
            'name.min' => 'É necessário no mínimo :min caracteres no nome!',
            'string' => 'Campo :attribute só aceitar texto.',
            'max' => 'Limite máximo de caracteres ultrapassada no campo :attribute.',
            'min'=> 'Minimo de caracteres não atigindo, no campo :attribute.',
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
