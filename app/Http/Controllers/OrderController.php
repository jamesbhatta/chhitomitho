<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderProduct;
use App\User;
use Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        $orders = Order::with('orderProducts')->latest()->get();
        // return $orders;
        return view('order.list', compact('orders'));
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
            DB::commit();
            Cart::destroy();
        } catch (\Exception $e) {
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
        $this->authorize('update', $order);
        $couriers = User::couriers()->get();
        return view('order.edit', compact('order', 'couriers'));
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
        $this->authorize('update', $order);
        $order->fill([
            'partner_id'    => $request->partner_id,
            'courier_id'    => $request->courier_id,
            'status'    => $request->status,
            'order_notes' => $request->order_notes,
        ])->save();

        return redirect()->back()->with('success', 'Order updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function myOrders()
    {   
        $orders = Order::with('orderProducts')->latest()->mine()->get();
        return view('orders', compact('orders'));
    }
}
