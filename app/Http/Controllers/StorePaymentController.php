<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

class StorePaymentController extends Controller
{    
    /**
     * store
     *
     * @param  mixed $store
     * @return void
     */
    public function store(Request $request, Store $store)
    {
        if ($store->user_id == \Auth::user()->id) {
            $store->payment_requested_at = now();
            $store->requested_amount = $request->requested_amount;
            $store->update();
            return redirect()->back()->with('success', 'Payment request has been sent');
        } else {
            return redirect()->back()->with('error', 'Action not allowed');
        }
    }
}
