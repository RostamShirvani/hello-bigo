<?php

namespace App\Enums;

class ESMSChannel extends BaseEnum
{
    const KAVENEGAR = 1;
    const IPPANEL = 2;
    const GHASEDAK = 3;

    public static function all()
    {
        return [
            self::KAVENEGAR => 'کاوه نگار',
            self::IPPANEL => 'ippanel',
//            self::GHASEDAK => 'قاصدک',
        ];
    }
}
