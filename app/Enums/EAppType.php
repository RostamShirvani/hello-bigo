<?php

namespace App\Enums;

class EAppType extends BaseEnum
{
    const BIGO_LIVE = 1;
    const LIKEE = 2;
    const TYPE_PUBG = 3;
    const TYPE_IMO = 4;

    public static function all()
    {
        return [
            self::BIGO_LIVE => 'BIGO LIVE',
            self::LIKEE => 'LIKEE',
        ];
    }

    public static function other()
    {
        return [
            self::TYPE_PUBG => 'PUBG',
            self::TYPE_IMO => 'IMO',
        ];
    }

    // Method to combine all types
    public static function getAppTypes()
    {
        return self::all() + self::other();
    }

    // Method to get readable name
    public static function getName($type)
    {
        $types = self::getAppTypes();
        return $types[$type] ?? 'Unknown';
    }
}
