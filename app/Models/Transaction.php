<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $guarded = [];

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
