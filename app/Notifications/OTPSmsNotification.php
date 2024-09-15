<?php

namespace App\Notifications;

use App\Enums\ESMSChannel;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OTPSmsNotification extends Notification
{
    use Queueable;

    public $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (Setting::get()->sms_channel == ESMSChannel::KAVENEGAR) {
            return [\App\Channels\kavenegar\SmsChannel::class];
        } elseif (Setting::get()->sms_channel == ESMSChannel::IPPANEL) {
            return [\App\Channels\ippanel\SmsChannel::class];
        } elseif (Setting::get()->sms_channel == ESMSChannel::GHASEDAK) {
            return [\App\Channels\ghasedak\SmsChannel::class];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toSms($notifiable)
    {
        return $this->code;
    }
}
