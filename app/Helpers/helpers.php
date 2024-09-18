<?php


use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Province;
use Carbon\Carbon;

function generateFileName($name)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $microsecond = Carbon::now()->microsecond;

    return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
}

function convertShamsiToGregorianDate($date)
{
    if ($date == null) {
        return null;
    }
    $pattern = "/[-\s]/";
    $shamsidateSplit = preg_split($pattern, $date);
    $arrayGregorianDate = verta()->jalaliToGregorian($shamsidateSplit[0], $shamsidateSplit[1], $shamsidateSplit[2]);
    return implode("-", $arrayGregorianDate) . " " . $shamsidateSplit[3];
}

function cartTotalDiscountAmount($cartContent = null)
{
    $cartTotalDiscountAmount = 0;
    if ($cartContent != null) {
        foreach ($cartContent as $item) {
            if ($item->attributes->is_sale) {
                $cartTotalDiscountAmount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
            }
        }
    }
    foreach (\Cart::getContent() as $item) {
        if ($item->attributes->is_sale) {
            $cartTotalDiscountAmount += $item->quantity * ($item->attributes->price - $item->attributes->sale_price);
        }
    }
    return $cartTotalDiscountAmount;
}

function cartTotalDeliveryAmount()
{
    $cartTotalDeliveryAmount = 0;
    foreach (\Cart::getContent() as $item) {
        $cartTotalDeliveryAmount += $item->associatedModel->delivery_amount;
    }
    return $cartTotalDeliveryAmount;
}

function checkCoupon($code)
{
    $coupon = Coupon::query()->where('code', $code)->where('expired_at', '>', Carbon::now())->first();

    if ($coupon == null) {
        session()->forget('coupon');
        return ['error' => 'کد تخفیف وارد شده معتبر نمی باشد!'];
    }
    if (Order::query()->where('user_id', auth()->id())->where('coupon_id', $coupon->id)->where('payment_status', 1)->exists()) {
        return ['error' => 'شما قبلا از این کد تخفیف استفاده نموده اید!'];
    }
    if ($coupon->getRawOriginal('type') == 'amount') {
        session()->put('coupon', ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $coupon->amount]);
    } else {
        $total = \Cart::getTotal();
        $amount = min((($total * $coupon->percentage) / 100), $coupon->max_percentage_amount);
        session()->put('coupon', ['id' => $coupon->id, 'code' => $coupon->code, 'amount' => $amount]);
    }
    return ['success' => 'کد تخفیف برای شما ثبت شد.'];
}

function cartTotalAmount()
{
    if (session()->has('coupon')) {
        return max((\Cart::getTotal() + cartTotalDeliveryAmount()) - session()->get('coupon.amount'), 0);
    } else {
        return \Cart::getTotal() + cartTotalDeliveryAmount();
    }
}

function province_name($provinceId)
{
    return Province::query()->findOrFail($provinceId)->name;
}

function city_name($cityId)
{
    return City::query()->findOrFail($cityId)->name;
}

if (!function_exists('convertPersianNumbers')) {
    function convertPersianNumbers($string) {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persianNumbers, $englishNumbers, $string);
    }
}
