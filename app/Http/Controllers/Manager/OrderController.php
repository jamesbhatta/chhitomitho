<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = Order::with('orderProducts')->latest()->get();
        // // return $orders;
        // return view('orders', compact('orders'));
    }
}
