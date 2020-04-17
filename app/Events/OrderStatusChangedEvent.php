<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $oldStatus;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Order $order, $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;

        // \DB::connection()->enableQueryLog();
        // $order->load('store', 'store.owner', 'courier');
        // dump($order->store->owner);
        // $order->store->owner->id;
        // $order->courier_id;
        // $queries = \DB::getQueryLog();
        // return dd($queries);
    }
    
}
