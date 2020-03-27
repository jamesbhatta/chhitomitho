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
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name, '-');
        }
        $category->save();

        return redirect()->back()->with('success', 'Category has been added.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->name;
        if ($request->slug) {
            $category->slug = $request->slug;
        } else {
            $category->slug = Str::slug($request->name, '-');
        }
        $category->save();

        return redirect()->back()->with('success', 'Category has been updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category has been delted.');
    }
}
