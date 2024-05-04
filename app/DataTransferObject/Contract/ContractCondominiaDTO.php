<?php
namespace App\DataTransferObject\Contract;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\UploadedFile;;

class ContractCondominiaDTO extends AbstractDTO implements InterfaceDTO
{
    public readonly int $ceo_id;
    public function __construct(

        // date contract condominia
        public readonly ?UploadedFile $document = null,
        public readonly ?string $initial_date= null,
        public readonly ?string $final_date= null,
        public readonly ?bool $ceo = null,
        public readonly ?int $condominia_id=null,
        // public readonly ?int $responsible_id,

    )
    {
        $this->ceo_id = $this->$ceo ?? auth()->user()->id;
        $this->validate();
    }
    public function getInitialDate() :Carbon
    {
        return Carbon::parse($this->initial_date);
    }
    public function getFinalDate() :Carbon
    {
        return Carbon::parse($this->final_date);
    }
    public function rules():array
    {
        return [
            'document' => 'required|file|mimes:pdf|max:2048',
            'condominia_id' => 'required|integer|exists:condominias,id',
            'initial_date' => 'required|date_format:d-m-Y',
            'final_date' => 'required|date_format:d-m-Y',
            'ceo' => 'required|boolean',
            // 'responsible_id' => 'required|exists:accounts,user_id',
        ];
    }
    public function messages():array
    {
        return [
            'ceo.required' => 'Esses campo é obrigatorio, selecionar positivo ou negativo!'
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
