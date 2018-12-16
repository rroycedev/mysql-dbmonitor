<?php
namespace App\Helpers;

class Nexmo
{
    public static function sendSMS($to, $message)
    {
        $basic = new \Nexmo\Client\Credentials\Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $to,
            'from' => env('NEXMO_FROM_PHONE_NUMBER'),
            'text' => $message,
        ]);
    }
}
