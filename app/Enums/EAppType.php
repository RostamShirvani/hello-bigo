<?php

namespace App\Enums;

class EAppType extends BaseEnum
{
    const BIGO_LIVE = 1;
    const LIKEE = 2;

    public static function all()
    {
        return [
            self::BIGO_LIVE => 'BIGO LIVE',
            self::LIKEE => 'LIKEE',
        ];
    }
}
