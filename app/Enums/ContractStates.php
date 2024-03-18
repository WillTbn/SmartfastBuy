<?php

namespace App\Enums;

Enum ContractStates : string
{
    case Draft = 'draft';
    case Initial = 'initial';
    case Pending = 'Pending';
    case Start = 'start';
}
