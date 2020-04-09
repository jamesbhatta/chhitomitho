<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{    
    /**
     * Shows the application homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('products')->ordered()->get();
        return view('welcome', compact('categories'));
    }
}
