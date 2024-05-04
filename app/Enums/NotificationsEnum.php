<?php

namespace App\Enums;

enum NotificationsEnum : string
{
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';
    public static function forSelectName(): array
    {
      return array_combine(
          array_column(self::cases(), 'name'),
          array_column(self::cases(), 'value'),
      );
    }
}
