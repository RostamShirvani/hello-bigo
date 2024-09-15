<?php

namespace App\PaymentGateway;

class Zibal extends Payment
{
    public function send($amounts, $description, $addressId, $mobile = null, $email = null)
    {
        $data = [
            'merchant' => 'zibal', // از حساب تستی استفاده می‌کنیم
            'amount' => (int)$amounts['paying_amount'], // مبلغ به ریال
            'callbackUrl' => route('home.payment_verify', 'zibal'), // آدرس بازگشت برای تایید پرداخت
            'description' => $description, // توضیحات سفارش
            'mobile' => $mobile ?? '-', // شماره موبایل اختیاری
            'orderId' => uniqid(), // شناسه منحصربه‌فرد سفارش اختیاری
        ];

        $jsonData = json_encode($data);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://gateway.zibal.ir/v1/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ],
        ]);

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if (isset($result['trackId'])) {
                $createOrder = parent::createOrder($addressId, $amounts, $result['trackId'], 'zibal');
                if (array_key_exists('error', $createOrder)) {
                    return $createOrder;
                }
                return ['success' => 'https://gateway.zibal.ir/start/' . $result['trackId']];
            } else {
                return ['error' => 'ERR: ' . $result['result'] . ' - ' . $result['message']];
            }
        }
    }

    public function verify($amount, $trackId)
    {
        $data = [
            'merchant' => 'zibal', // استفاده از حساب تستی
            'trackId' => $trackId, // شناسه پیگیری دریافت‌شده از درخواست پرداخت
        ];

        $jsonData = json_encode($data);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://gateway.zibal.ir/v1/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ],
        ]);

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if (isset($result['result']) && $result['result'] == 100) {
                $updateOrder = parent::updateOrder($trackId, $result['refNumber']);
                if (is_array($updateOrder) && array_key_exists('error', $updateOrder)) {
                    return $updateOrder;
                }
                return [
                    'success' => 'پرداخت با موفقیت انجام شد. ' . 'شماره پیگیری: ' . $result['refNumber'],
                    'order' => $updateOrder
                ];
            } else {
                return ['error' => 'Verification failed. ERR: ' . $result['result'] . ' - ' . $result['message']];
            }
        }
    }
}
