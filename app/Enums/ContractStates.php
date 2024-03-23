<?php

namespace App\Enums;

Enum ContractStates : string
{
    case Negotiate = 'negotiate';
    case Draft = 'draft';
    case Initial = 'initial';
    case Pending = 'Pending';
    case Start = 'start';
}
