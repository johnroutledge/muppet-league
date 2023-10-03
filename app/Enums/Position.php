<?php

namespace App\Enums;

enum Position: int
{
    case GOALKEEPER = 1;
    case DEFENDER = 2;
    case MIDFIELDER = 3;
    case FORWARD = 4;

    public static function getNames(): array
    {
        return [
            self::GOALKEEPER => ['full' => 'Goalkeeper', 'short' => 'GK'],
            self::DEFENDER => ['full' => 'Defender', 'short' => 'DEF'],
            self::MIDFIELDER => ['full' => 'Midfielder', 'short' => 'MID'],
            self::FORWARD => ['full' => 'Forward', 'short' => 'FWD'],
        ];
    }
}