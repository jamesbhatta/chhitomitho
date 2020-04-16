<?php

namespace App\Listeners;

use App\Events\OrderStatusChangedEvent;
use App\Jobs\SendSmsJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SmsOrderStatusListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  OrderStatusChangedEvent  $event
     * @return void
     */
    public function handle(OrderStatusChangedEvent $event)
    {
        $message = null;
        switch ($event->order->status) {
            case "confirmed":
                $message = createOrderConfirmedSMS($event->order);
                break;
            case "shipped":
                $message = createOrderShippedSMS($event->order);
                break;
            case "delivered":
                $message = createOrderDeliveredSMS($event->order);
                break;
        }
        if (!is_null($message)) {
            Log::info($message);
            SendSmsJob::dispatch($event->order->billing_phone, $message);
        }
    }
}
