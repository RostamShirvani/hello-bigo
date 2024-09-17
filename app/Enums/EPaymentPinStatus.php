<?php

namespace App\Enums;

class EPaymentPinStatus extends BaseEnum
{
    const UNUSED = 1;
    const USED = 2;
    const REJECTED = 3;

    public static function all()
    {
        return [
            self::UNUSED => 'آزاد',
            self::USED => 'استفاده شده',
            self::REJECTED => 'رد شده',
        ];
    }
    public static function getStatus()
    {
        return self::all();
    }

    // Method to get readable name
    public static function getName($status)
    {
        $statuses = self::getStatus();
        return $statuses[$status] ?? 'Unknown';
    }
}
