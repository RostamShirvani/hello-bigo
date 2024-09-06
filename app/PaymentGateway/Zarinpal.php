<?php

namespace App\PaymentGateway;

class Zarinpal extends Payment
{
    public function send($amounts, $description, $addressId, $mobile = null, $email = null)
    {
        $data = array(
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
            'amount' => (int)$amounts['paying_amount'],
            'callback_url' => route('home.payment_verify', 'zarinpal'),
            'description' => $description,
            'metadata' => array(
                'mobile' => $mobile ?? '-',  // Optional mobile number
                'email' => $email     // Optional email
            )
        );

        $jsonData = json_encode($data);

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://payment.zarinpal.com/pg/v4/payment/request.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Content-Length: ' . strlen($jsonData)
            ),
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if (isset($result['data']['code']) && $result['data']['code'] == 100) {
                $createOrder = parent::createOrder($addressId, $amounts, $result['data']['authority'], 'zarinpal');
                if (array_key_exists('error', $createOrder)) {
                    return $createOrder;
                }
                return ['success' => 'https://payment.zarinpal.com/pg/StartPay/' . $result['data']['authority']];
            } else {
                return ['error' => 'ERR: ' . $result['errors']['code'] . ' - ' . $result['errors']['message']];
            }
        }
    }


    public function verify($amount, $authority)
    {
        $data = array(
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
            'amount' => (int)$amount,
            'authority' => $authority
        );

        $jsonData = json_encode($data);

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://payment.zarinpal.com/pg/v4/payment/verify.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Content-Length: ' . strlen($jsonData)
            ),
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if (isset($result['data']['code']) && $result['data']['code'] == 100) {
                $updateOrder = parent::updateOrder($authority, $result['data']['ref_id']);
                if (array_key_exists('error', $updateOrder)) {
                    return $updateOrder;
                }
                \Cart::clear();
                return ['success' => 'Transaction verified successfully', 'ref_id' => $result['data']['ref_id']];
            } else {
                return ['error' => 'Verification failed. ERR: ' . $result['errors']['code'] . ' - ' . $result['errors']['message']];
            }
        }
    }

}
