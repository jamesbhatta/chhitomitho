<?php
return [
    'token' => env('SMS_TOKEN'),
    'sender' => env('SMS_SENDER'),
    'url' => env('SMS_URL', 'http://sms.bmpinfology.com/api/v3/sms?'),
];