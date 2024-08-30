<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class BaseEnum extends Enum
{
    public static function toFlipArray()
    {
        return array_flip(static::toArray());
    }

    public static function flipTrans($prefix = null)
    {
        $classNameArray = explode('\\', static::class);
        $className = end($classNameArray);
        $prefix = (empty($prefix) ? "admin/enum.{$className}." : "{$prefix}/enum.{$className}.");

        return array_map(function ($item) use ($prefix) {
            return __($prefix . $item);
        }, static::toFlipArray());
    }

    public static function getTrans($key, $prefix = null, $default = null)
    {
        if (empty($key)) {
            $key = $default;
        }

        if (array_key_exists($key, self::flipTrans($prefix))) {
            return self::flipTrans($prefix)[$key];
        }

        return null;
    }

    public static function getRandom()
    {
        return array_rand(self::toFlipArray());
    }

    public static function get($key)
    {
        return !empty(self::toArray()[$key]) ? self::toArray()[$key] : null;
    }

    public static function getFlip($key)
    {
        return !empty(self::toFlipArray()[$key]) ? self::toFlipArray()[$key] : null;
    }

    public static function toJson()
    {
        return json_encode(self::toArray(), JSON_UNESCAPED_UNICODE);
    }

    public static function has($key)
    {
        return !empty(self::toFlipArray()[$key]);
    }
}
