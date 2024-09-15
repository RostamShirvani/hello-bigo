<?php

namespace App\Channels\kavenegar;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $receptor = $notifiable->cellphone; // شماره گیرنده
        $token = $notification->code; // کد تأیید (OTP)
        $template = 'bigopuls'; // نام الگوی تأیید که در کاوه نگار تعریف کرده‌اید

        // بررسی اینکه شماره گیرنده وجود داشته باشد
        if (!$receptor) {
            return;
        }

        // ایجاد درخواست HTTP برای ارسال پیامک از طریق کاوه نگار
        $client = new Client();
        $apiKey = env('KAVENEGAR_API_KEY'); // دریافت API KEY از تنظیمات محیطی

        try {
            $response = $client->request('GET', "https://api.kavenegar.com/v1/{$apiKey}/verify/lookup.json", [
                'query' => [
                    'receptor' => $receptor,
                    'token' => $token,
                    'template' => $template,
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            // بررسی وضعیت ارسال پیامک
            if (isset($body['return']['status']) && $body['return']['status'] == 200) {
                // پیامک با موفقیت ارسال شد
                return 'Done!';
            } else {
                // پیامک ارسال نشد
                throw new \Exception('Failed to send SMS.');
            }
        } catch (\Exception $e) {
            // هندل کردن خطا در ارسال پیامک
            \Log::error("Failed to send OTP SMS: " . $e->getMessage());
        }
    }
}
