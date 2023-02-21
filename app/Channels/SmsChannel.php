<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $receptor = $notifiable->cellphone;
        $type = 1; // this value is set by default in verify function
        $template = "my-template";
        $param1 = $notification->code;
        $api = new \Ghasedak\GhasedakApi(env('GHASEDAK_API_KEY'));
        $api->Verify($receptor, $template, $param1);
    }
}
