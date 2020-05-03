<?php

namespace App\Http\Controllers;

use App\CourierLedger;
use App\Events\OrderStatusChangedEvent;
use App\Http\Requests\OrderRequest;
use App\Jobs\OrderPlacedJob;
use App\Jobs\SendSmsJob;
use App\LedgerEntry;
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
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);
        DB::table('notifications')->where('type', 'App\Notifications\NewOrder')->where('notifiable_id', Auth::user()->id)->delete();

        $orderNumber = $request->has('order_number') ? $request->order_number : null;
        $name = $request->has('name') ? $request->name : null;
        $orders = Order::with('orderProducts', 'user', 'store', 'store.owner', 'courier');

        if ($orderNumber) {
            $orders = $orders->where('id', $orderNumber);
        }
        if ($name) {
            $orders = $orders->where('billing_name', 'like', "%$name%");
        }
        if ($request->has('filter')) {
            $orders = $orders->where('status', $request->filter);
        }
        $orders = $orders->latest()->paginate(config('constants.order.items_per_page', 15));

        return view('order.list')->with([
            'orders' => $orders,
            'filter' => $request->filter ?? "all",
            'order_number' => $request->order_number ?? null,
            'name' => $request->name ?? null,
        ]);
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

            // Store user detals if not available
            $user = Auth::user();
            if (is_null($user->mobile)) {
                $user->mobile = $request->billing_phone;
            }
            if (is_null($user->address)) {
                $user->address = $request->billing_address;
            }
           $user->update();

            DB::commit();
            Cart::destroy();
        } catch (\Exception $e) {
            Log::error('Exception caught in OrderController@store: ' . $e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'An unknown error occured. Please try again.');
        }

        // return redirect()->route('customer.orders')->with('success', 'Your order has been placed.');
        return redirect()->route('customer.order_placed');
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
            if($request->has('processed')) {
                $this->authorize('markProcessed', $order);
                $order->fill(['status' => 'processing'])->save();
                $response = "The order #$order->id has been marked as Processing.";
            } elseif ($request->has('dispatched')) {
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
                    'store_notes' => $request->store_notes,
                    'courier_notes' => $request->courier_notes
                ])->save();
                $response = "The order #$order->id has been Updated.";
            }

            if ($order->wasChanged('status') && $order->status == 'shipped') {
                $sellingPrice = $order->total_price;
                $amountAfterCommission = ((100 - $order->store->commission_percentage) / 100) * $sellingPrice;
                LedgerEntry::credit($order->store_id, $amountAfterCommission, 'Order ' . $order->orderNumber, $sellingPrice);
            }

            if ($order->wasChanged('status') && $order->status == 'delivered') {
                $sellingPrice = $order->total_price;
                $commissionAmount = $sellingPrice - (((100 - $order->courier->meta->commission_percentage) / 100) * $sellingPrice);
                CourierLedger::credit($order->courier_id, $commissionAmount, 'Order ' . $order->orderNumber, $sellingPrice);
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

    // moveed to CustomerOrderController
    public function myOrders()
    {
        $orders = Order::with('orderProducts', 'store', 'courier')->latest()->mine()->paginate(config('constants.my_orders.items_per_page'));
        return view('orders', compact('orders'));
    }

    public function orderPlaced()
    {
        return view('order.placed');
    }
}
