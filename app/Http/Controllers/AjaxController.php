<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function newOrdersCount()
    {
        $count = DB::table('notifications')->where('type', 'App\Notifications\NewOrder')->where('notifiable_id', Auth::user()->id)->count();
        return response()->json(['count' => $count]);
    }

    public function newOrderConfirmedCount()
    {
        $count = DB::table('notifications')->where('type', 'App\Notifications\OrderConfirmed')->where('notifiable_id', Auth::user()->id)->count();
        return response()->json(['count' => $count]);
    }

    public function pushSalesProducts()
    {
        // \DB::enableQueryLog();
        $products = \App\Product::inRandomOrder()->limit(4)->get();
        // dd(\DB::getQueryLog());
        $products->map(function($product) {
            return $product['product_image_url'] = asset('/storage/' . $product->product_image);
        });
        return $products;
    }
}
