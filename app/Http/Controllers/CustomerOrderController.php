<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('orderProducts', 'store', 'courier');

        $filter = $request->has('filter') ? $request->filter : null;

        if($filter == 'unreceived') {
            $orders = $orders->whereStatus('pending_payment')
                            ->orWhere('status', 'pending')
                            ->orWhere('status', 'confirmed')
                            ->orWhere('status', 'processing')
                            ->orWhere('status', 'shipped');
        }

        if($filter == 'received') {
            $orders = $orders->whereStatus('delivered');
        }

        if($filter == 'cancelled') {
            $orders = $orders->whereStatus('cancelled');
        }

        $orders = $orders->latest()->mine()->paginate(config('constants.my_orders.items_per_page'));
        return view('orders', compact('orders'));
    }
}
