<?php

namespace App\Notifications\Channels;
use Illuminate\Notifications\Notification;

class GhasedakSms
{
    
    public function send($notifiable , Notification $notification)
    {
            // $message = $notification->toGhasedakSms($notifiable)['text'];
            // $lineNumber = "10008566";
            // $receptor = $notification->number;
            // $api = new GhasedakApi(config('service.ghasedak.key'));
            // $api->SendSimple($receptor,$message,$lineNumber);
            
            try 
{
    $message = $notification->toGhasedakSms($notifiable)['text'];
    $lineNumber = "10008566";
    $receptor = $notification->number;
    $api = new \Ghasedak\GhasedakApi(config('service.ghasedak.key'));
    $api->SendSimple($receptor,$message,$lineNumber);
}
catch(\Ghasedak\Exceptions\ApiException $e){
    throw $e;
}
catch(\Ghasedak\Exceptions\HttpException $e){
    throw $e;
}
    }
    
}