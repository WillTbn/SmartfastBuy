<?php

namespace App\Enums;

Enum ContractStates : string
{
    case Negotiate = 'negotiate';
    case Draft = 'draft';
    case Initial = 'initial';
    case Pending = 'Pending';
    case Start = 'start';
    public static function forSelectName(): array
    {
      return array_combine(
          array_column(self::cases(), 'name'),
          array_column(self::cases(), 'value'),
      );
    }
}
