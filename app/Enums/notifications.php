<?php

namespace App\Enums;

enum notifications:string
{
    CASE ACCEPTED = 'A';
    CASE REFUSED = 'R';

    public function getValue(): string
    {
        return $this->value;

    }
    public function getName():string
    {
        return $this->name;
    }
}
