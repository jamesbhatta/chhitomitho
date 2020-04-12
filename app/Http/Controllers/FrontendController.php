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
        $categories = Category::active()->with('products')->orderByFeatured()->ordered()->get();
        return view('welcome', compact('categories'));
    }
}
