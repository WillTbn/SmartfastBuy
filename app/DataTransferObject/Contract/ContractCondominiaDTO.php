<?php
namespace App\DataTransferObject\Contract;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
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
        public readonly ?bool $ceo = false,
        public readonly ?int $condominia_id=null,
        public readonly ?int $responsible_id,

    )
    {
        $this->ceo_id = $this->$ceo ?? auth()->user()->id;
        $this->validate();
    }
    public function rules():array
    {
        return [
            'document' => 'required|file|mimes:pdf|max:2048',
            'condominia_id' => 'required|integer|exists:condominias,id',
            'initial_date' => 'required|string',
            'final_date' => 'required|string',
            'ceo' => 'required|boolean',
            'responsible_id' => 'required|exists:accounts,user_id',
        ];
    }
    public function messages():array
    {
        return [];
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
