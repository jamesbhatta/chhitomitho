<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CourierPaymentController extends Controller
{
    public function store(Request $request, $id)
    {
        $courier = User::couriers()->findOrFail($id);
        
        if ($courier->id == \Auth::user()->id) {
            $courier->meta->payment_requested_at = now();
            $courier->meta->requested_amount = $request->requested_amount;
            $courier->meta->update();
            return redirect()->back()->with('success', 'Payment request has been sent');
        } else {
            return redirect()->back()->with('error', 'Action not allowed');
        }
    }
}
