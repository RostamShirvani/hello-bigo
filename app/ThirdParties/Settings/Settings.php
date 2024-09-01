<?php

namespace App\ThirdParties\Settings;

use anlutro\LaravelSettings\Facades\Setting;

class Settings
{
    public static function set($key, $value = null)
    {
        Setting::set($key, $value);
        self::save();
    }

    public static function get($key, $default = null)
    {
        return Setting::get($key, $default);
    }

    public static function save()
    {
        Setting::save();
    }
}
