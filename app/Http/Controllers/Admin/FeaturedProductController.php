<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids = explode(',', $request->product_ids);
        Product::whereIn('id', $ids)->update(['featured' => true]);
       
        return redirect()->back()->with('success', 'Selected products has been marked as featured');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = explode(',', $request->product_ids);
        Product::whereIn('id', $ids)->update(['featured' => false]);
       
        return redirect()->back()->with('success', 'Selected products has been removed from featured list');
    }
}
