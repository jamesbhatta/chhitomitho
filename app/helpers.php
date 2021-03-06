<?php

if (!function_exists('sendSms')) {
    function sendSMS($to, $message)
    {
        $token = config('notification.sms.token');
        $sender = config('notification.sms.sender');
        $url = config('notification.sms.url');

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

if (!function_exists('createOrderConfirmedSMS')) {
    function createOrderConfirmedSMS($order)
    {
        return "Dear " . $order->user->name . ",\r\nyour order #$order->id has been confirmed and is now being processed.\r\nLatest status of your order can be found at " . route('customer.orders');
    }
}

if (!function_exists('createConfirmedOrderSMSForPartner')) {
    function createConfirmedOrderSMSForPartner($order)
    {
        return "A new order #($order->id) has arrived.\r\nPlease process the order as quickly as possible.\r\nFor Details, " . route('customer.orders');
    }
}

if (!function_exists('createConfirmedOrderSMSForCourier')) {
    function createConfirmedOrderSMSForCourier($order, $storeName)
    {
        return "Pick order #($order->id) from $storeName.\r\nDetails, " . route('customer.orders');
    }
}


if (!function_exists('createOrderShippedSMS')) {
    function createOrderShippedSMS($order)
    {
        return "Dear " . $order->user->name . ",\r\nyour order #$order->id has been dispatched and is on the way.\r\nLatest status can be found at " . route('customer.orders');
    }
}

if (!function_exists('createOrderDeliveredSMS')) {
    function createOrderDeliveredSMS($order)
    {
        return "Dear " . $order->user->name . ",\r\nyour order #$order->id has been completed.\r\nThank you for choosing us.\r\nRegards,\r\nChhitomitho Team";
    }
}

if (!function_exists('statusBadgeClass')) {
    function statusBadgeClass($status)
    {
        switch ($status) {
            case "pending_payment":
                $class = "badge-warning";
                break;
            case "pending":
                $class = "badge-default";
                break;
            case "confirmed":
                $class = "badge-secondary";
                break;
            case "processing":
                $class = "badge-info";
                break;
            case "shipped":
                $class = "badge-primary";
                break;
            case "delivered":
                $class = "badge-success";
                break;
            case "cancelled":
                $class = "badge-danger";
                break;
            default:
                $class = "badge-light";
                break;
        }
        return $class;
    }
}


if (!function_exists('isPaymentComplete')) {
    function isPaymentComplete($order)
    {
        return $order->payment_mode == 'esewa' && !isset($order->transaction_time);
    }
}

if (!function_exists('moneyFormat')) {
    function moneyFormat($amount)
    {
        return 'NRs. ' . number_format($amount);
    }
}


if (! function_exists('setActive')) {
	/**
	 * Check if the route is active or not
	 *
	 * @param  string  $key
	 * @return string
	 */
	function setActive($path, $active = 'active') {
		return Request::routeIs($path) ? $active : '';
	}
}