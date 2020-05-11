<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function counts()
    {
        $data = Cache::remember('dashboard-item-counts', 10, function () {
            return DB::select("SELECT 
                (SELECT COUNT(*) FROM users) as customerCount,
                (SELECT COUNT(*) FROM users) as courierCount,
                (SELECT COUNT(*) FROM stores) as storeCount,
                (SELECT COUNT(*) FROM categories) as categoryCount,
                (SELECT COUNT(*) FROM products) as productCount
                ");
        });
        $data = collect($data)->first();

        return response()->json($data);
    }
}
