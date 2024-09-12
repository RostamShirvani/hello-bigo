<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $guarded = [];

    // Define gateway names as constants
    public const GATEWAY_ZARINPAL = 'zarinpal';
    public const GATEWAY_PAY = 'pay';
    public const GATEWAY_ZIBAL = 'zibal';
    public const GATEWAY_FREE = 'free';

    // Use the constants in the enum field
    public static function getGatewayNames(): array
    {
        return [
            self::GATEWAY_ZARINPAL,
            self::GATEWAY_PAY,
            self::GATEWAY_ZIBAL,
            self::GATEWAY_FREE,
        ];
    }
    public function getStatusAttribute($status)
    {
        return match ($status) {
            0 => 'ناموفق',
            1 => 'موفق',
        };
    }

    public function scopeGetData($query, $month, $status)
    {
        $v = verta()->startMonth()->subMonths($month-1);
        $date = verta($v)->toCarbon();
        return $query->where('created_at', '>', $date)
            ->where('status', $status)
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
