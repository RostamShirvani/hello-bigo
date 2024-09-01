<?php

namespace App\ThirdParties\OTP;

use App\Models\OTPCode\OTPCode;
use Carbon\Carbon;

class OTP
{
    public static function set($key, $value)
    {
        OTPCode::query()
            ->updateOrCreate([
                'key' => $key,
            ], [
                'key' => $key,
                'value' => $value,
                'expired_at' => Carbon::now()->addMinutes(2),
            ]);
    }

    public static function get($key)
    {
        $OTPCode = OTPCode::query()
            ->select([
                'value'
            ])
            ->where([
                ['key', $key],
                ['expired_at', '>=', Carbon::now()]
            ])
            ->orderBy('expired_at', 'desc')
            ->first();

        if ($OTPCode) {
            return $OTPCode->value;
        }

        return null;
    }

    public static function forget($key)
    {
        OTPCode::query()
            ->where('key', $key)
            ->delete();
    }
}
