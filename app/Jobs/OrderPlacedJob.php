<?php

namespace App\Jobs;

use App\Mail\OrderPlaced;
use App\Notifications\NewOrder;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderPlacedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Order placed job is executed');
        // Mail::to($this->order->user->email)->send(new OrderPlaced($this->order));
        $users = \App\User::where('role', 'manager')->first();
        Notification::send ($users, new NewOrder($this->order));
    }
}
