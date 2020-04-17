<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusChangedEvent;
use App\Http\Requests\OrderRequest;
use App\Jobs\OrderPlacedJob;
use App\Jobs\SendSmsJob;
use App\Notifications\NewOrder;
use App\Order;
use App\OrderProduct;
use App\Store;
use App\User;
use Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Order::class);
        $orders = Order::with('orderProducts', 'user', 'store', 'store.owner', 'courier')->latest()->paginate(config('constants.order.items_per_page', 15));
        // return $orders;
        return view('order.list', compact(['orders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->fill($request->all());
            $order->fill([
                'user_id' => Auth::user()->id,
                'total_price' => Cart::total(0, '', ''),
                'status' => 'pending',
                'customer_ip' => \Request::ip(),
            ])->save();

            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'name' => $item->name,
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price
                ]);
            }

            // Instead fire an Order Placed Event
            OrderPlacedJob::dispatch($order);
            // $to = $order->billing_phone;
            // $message = $this->createOrderReveivedSMS($order);
            // SendSmsJob::dispatch($to, $message);
            DB::commit();
            Cart::destroy();
        } catch (\Exception $e) {
            Log::error('Exception caught in OrderController@store: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'An unknown error occured. Please try again.');
        }

        return redirect()->route('customer.orders')->with('success', 'Your order has been placed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $this->authorize('view', $order);
        // $order->load('orderProducts');
        $couriers = User::couriers()->get();
        $stores = Store::sortByName()->get();
        return view('order.edit', compact(['order', 'couriers', 'stores']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        DB::beginTransaction();
        try {
            if ($request->has('dispatched')) {
                $this->authorize('markDispatched', $order);
                $order->fill(['status' => 'shipped'])->save();
                $response = "The order #$order->id has been marked as Dispatched.";
            } elseif ($request->has('delivered')) {
                $this->authorize('markDelivered', $order);
                $order->fill(['status' => 'delivered'])->save();
                $response = "The order #$order->id has been marked as Delivered.";
            } else {
                $this->authorize('update', $order);
                $order->fill([
                    'store_id'    => $request->store_id,
                    'courier_id'    => $request->courier_id,
                    'status'    => $request->status,
                    'order_notes' => $request->order_notes,
                ])->save();
                $response = "The order #$order->id has been Updated.";
            }

            DB::commit();
            if ($order->wasChanged('status')) {
                event(new OrderStatusChangedEvent($order, $request->status));
            }
        } catch (\Exception $e) {
            Log::error('Exception caught in OrderController@update: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'An unknown error occured. Please try again.');
        }

        return redirect()->back()->with('success', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();

        return redirect()->back()->with('success', 'Order has been deleted permanently');
    }

    public function myOrders()
    {
        $orders = Order::with('orderProducts', 'store', 'courier')->latest()->mine()->paginate(config('constants.my_orders.items_per_page'));
        return view('orders', compact('orders'));
    }
}
