<?php

namespace App\Enums;

enum genre:string
{
    case Masculino = 'M';
    case Feminino = 'F';
    case other = 'O';
    case notinfo = 'N';

    public function getValue(): string
    {
        return $this->value;

    }
    public function getName():string
    {
        return $this->name;
    }
}
