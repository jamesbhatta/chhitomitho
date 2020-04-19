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
}
