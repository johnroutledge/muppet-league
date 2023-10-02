<?php

namespace App\Enums;

enum PositionType: int
{
    case GOALKEEPER = 1;
    case DEFENDER = 2;
    case MIDFIELDER = 3;
    case FORWARD = 4;

    public static function getNames(): array
    {
        return [
            self::GOALKEEPER => 'Goalkeeper',
            self::DEFENDER => 'Defender',
            self::MIDFIELDER => 'Midfielder',
            self::FORWARD => 'Forward',
        ];
    }
}