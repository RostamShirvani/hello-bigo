<?php

namespace App\Channels\ippanel;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        require 'autoload.php';

        // you api key that generated from panel
        $apiKey = env('IPPANEL_ACCESS_KEY');

        $client = new \IPPanel\Client($apiKey);

        $patternValues = [
            "code" => $notification->code,
        ];

        $messageId = $client->sendPattern(
            "8q8i5z83hy",    // pattern code
//            "+985000125475",      // originator both of these originators work
            "+983000505",      // originator
            "$notifiable->cellphone",  // recipient
            $patternValues,  // pattern values
        );
    }
}
