<?php

if (!function_exists('sendSms')) {
    function sendSMS($to, $message)
    {
        $token = config('sms.token');
        $sender = config('sms.sender');
        $url = config('sms.url');

        $content = [
            'token' => rawurlencode($token),
            'to' => rawurlencode($to),
            'sender' => rawurlencode($sender),
            // 'message'=>rawurlencode($message),
            'message' => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
}
