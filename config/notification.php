<?php
return [
    'sms' => [
        'token' => env('SMS_TOKEN'),
        'sender' => env('SMS_SENDER'),
        'url' => env('SMS_URL', 'http://sms.bmpinfology.com/api/v3/sms?'),
        'notify_store' => env('SMS_STORE', false),
        'notify_courier' => env('SMS_COURIER', false),
    ],

    'slack' => [
        'url' => env('SLACK_URL'),
    ]
];
