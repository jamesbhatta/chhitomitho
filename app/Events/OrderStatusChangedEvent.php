<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
    public function __construct($order, $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }
    
}
