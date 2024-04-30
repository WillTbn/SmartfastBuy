<?php

namespace App\Enums;

Enum RoleEnum :int
{
    case Master = 1;
    case Seller = 2;
    case Responsible = 3;
    public static function forAbilitiesDefault(): array
    {
        return [
            self::Master->value =>[
                'name' => 'all-access'
            ],
            self::Seller->value =>[
                'name' => 'users-access'
            ],
            self::Responsible->value =>[
                'name' => 'condominia-access'
            ]
        ];
    }
    public static function forRoleIdName(): array
    {
        return [
            self::Master->value =>[
                'name' => self::Master->name
            ],
            self::Seller->value =>[
                'name' => self::Seller->name
            ],
            self::Responsible->value =>[
                'name' => self::Responsible->name
            ]
        ];
    }
}
