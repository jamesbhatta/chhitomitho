<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderByFeatured()->ordered()->get();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'nullable|numeric'
        ]);

        $category = new Category();
        $category->name = $request->name;
        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name, '-');
        }
        $category->order = $request->order;
        $category->save();

        return redirect()->back()->with('success', 'Category has been added.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'nullable|numeric'
        ]);

        $category->name = $request->name;
        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name, '-');
        }
        $category->order = $request->order;
        $category->active = $request->boolean('active');
        $category->featured = $request->boolean('featured');
        $category->save();

        return redirect()->back()->with('success', 'Category has been updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category has been delted.');
    }
}
