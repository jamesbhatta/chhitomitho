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
        $categories = Category::active()->where('slug', '!=', 'uncategorized')->with('products')->orderByFeatured()->ordered()->get();
        $featuredProducts = \App\Product::whereFeatured(true)->get();
        return view('welcome', compact('categories', 'featuredProducts'));
    }
}
