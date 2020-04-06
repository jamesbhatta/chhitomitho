<?php

namespace App\Http\Controllers;

use App\Store;
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
        $stores = Store::sortByName()->get();
        return view('checkout', compact('stores'));
    }
}
