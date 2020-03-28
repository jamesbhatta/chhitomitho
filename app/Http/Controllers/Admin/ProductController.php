<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(config('constants.product.items_per_page'));

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = Storage::putFile(config('constants.product.image_dir'), $request->file('product_image'));
        }

        $product = Product::create([
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sale_price_from' => $request->sale_price_from,
            'sale_price_to' => $request->sale_price_to,
            'min_quantity' => $request->min_quantity,
            'product_image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.edit', $product)->with('success', 'Product has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('product.edit', compact(['categories', 'product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $imagePath = $product->product_image;
        if ($request->hasFile('product_image')) {
            Storage::delete($product->product_image);
            $imagePath = Storage::putFile(config('constants.product.image_dir'), $request->file('product_image'));
        }

        $product->fill([
            'name' => $request->name,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'sale_price_from' => $request->sale_price_from,
            'sale_price_to' => $request->sale_price_to,
            'min_quantity' => $request->min_quantity,
            'product_image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        $product->update();

        return redirect()->back()->with('success', 'Product has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (Storage::exists($product->product_image)) {
            Storage::delete($product->product_image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product has been deleted.');
    }
}
