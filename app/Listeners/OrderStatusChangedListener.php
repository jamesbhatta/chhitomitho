<?php

namespace App\Listeners;

use App\Events\OrderStatusChangedEvent;
use App\Jobs\SendSmsJob;
use App\Notifications\OrderConfirmed;
use App\Notifications\OrderDelivered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use Illuminate\Queue\InteractsWithQueue;

class OrderStatusChangedListener  implements ShouldQueue
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
        \DB::connection()->enableQueryLog();
        $event->order->load('store', 'store.owner:id,mobile', 'courier:id,mobile');

        // dump($event->order->store->owner);
        // $event->order->store->owner->id;
        // $event->order->courier_id;
        // $queries = \DB::getQueryLog();
        // return dd($queries);

        switch ($event->order->status) {
            case "pending":
                // Send Notification to Database and Slack
            break;

            case "confirmed":
                // Send sms to Customer
                $to = $event->order->billing_phone;
                $message = createOrderConfirmedSMS($event->order);
                SendSmsJob::dispatch($to, $message);

                // Send SMS to Partner (Store owner)
                $to = $event->order->store->owner->mobile;
                $message = createConfirmedOrderSMSForPartner($event->order);
                SendSmsJob::dispatch($to, $message);
                
                // Send SMS to courier
                $to = $event->order->courier->mobile;
                $message = createConfirmedOrderSMSForCourier($event->order, $event->order->store->name);
                SendSmsJob::dispatch($to, $message);
                
                // Send Database Notification to Partner (store owner) and Courier
                $receivers = \App\User::whereIn('id', [$event->order->store->owner->id, $event->order->courier_id])->get();
                Notification::send($receivers, new OrderConfirmed($event->order));
            break;

            case "shipped":
                // Send SMS to customer
                $to = $event->order->billing_phone;
                $message = createOrderShippedSMS($event->order);
                SendSmsJob::dispatch($to, $message);
            break;

            case "delivered":
                // Send SMS to customer and Notify in Slack
                $to = $event->order->billing_phone;
                $message = createOrderDeliveredSMS($event->order);
                SendSmsJob::dispatch($to, $message);
                Notification::route('slack', config('notification.slack.url'))->notify(new OrderDelivered($event->order));
            break;
        }
    }
}
