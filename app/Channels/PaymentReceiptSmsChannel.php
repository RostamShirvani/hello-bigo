<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class PaymentReceiptSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        return 'Done!';
        $receptor = $notifiable->cellphone;
        $type = 1; // this value is set by default in verify function
        $template = "payementRecipt";
        $param1 = $notification->orderId;
        $param2 = $notification->amount;
        $param3 = $notification->refId;
        $api = new \Ghasedak\GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify($receptor, $template, $param1, $param2, $param3);
    }
}
