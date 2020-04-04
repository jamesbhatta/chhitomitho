<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!Cart::count())
        {
            return redirect()->route('cart');
        }
        return view('checkout');
    }
}
