<?php

namespace App\Notifications;

use GhasedakSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCodeNotification extends Notification
{
    use Queueable;

    public $code;
    public $number;

    

    public function __construct($code , $number)
    {
        $this->code = $code;
        $this->number = $number;
    }


    
    public function via($notifiable)
    {
        return [GhasedakSms::class];
    }


    
    public function toGhasedakSms($notifiable)
    {
        return [
            'text' => "Your verification code is",
        ];
    }

    
}
