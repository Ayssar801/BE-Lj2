<?php

namespace App\Enums;

enum UserRole: string
{
    case Beheerder = 'beheerder';
    case Magazijnmedewerker = 'magazijnmedewerker';
    case Klant = 'klant';

    public function label(): string
    {
        return match ($this) {
            self::Beheerder => 'Beheerder',
            self::Magazijnmedewerker => 'Magazijnmedewerker',
            self::Klant => 'Klant',
        };
    }
}
