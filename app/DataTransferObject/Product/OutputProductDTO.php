<?php

namespace App\DataTransferObject\Product;

use App\DataTransferObject\AbstractDTO;
use App\DataTransferObject\InterfaceDTO;
use Illuminate\Contracts\Validation\Validator;

class OutputProductDTO extends AbstractDTO implements InterfaceDTO
{
    public function rules():array{
        return [];
    }
    public function messages():array{
        return[];
    }
    public function validator():Validator{
        return validator($this->toArray(), $this->rules(), $this->messages());
    }
    public function validate():array{
        return[];
    }
}
