<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;

class CartController extends Controller
{
    /**
     * Shows the cart page
     *
     * @return view
     */
    public function index()
    {
        // return Cart::content();
        return view('cart.index');
    }

    /**
     * getItems
     *
     * @return json
     */
    public function getItems()
    {
        $cart = Cart::content();

        return response()->json($cart);
    }

    /**
     * summary
     *
     * @return json
     */
    public function summary()
    {
        $totalQuantity = Cart::count();
        $totalPrice = Cart::priceTotal();

        $data = [
            'status' => 200,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ];

        return response()->json($data);
    }

    /**
     * add
     *
     * @param  mixed $request
     * @return json
     */
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required'
        ]);

        $product = Product::findOrFail($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $price,
            'weight' => 0,
            'options' => [
                'product_image' => $product->product_image,
                'min_quantity' => $product->min_quantity
            ]
        ]);

        return response()->json(['status' => 200]);
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        $currentItem = Cart::get($rowId);

        if ($quantity != 0) {
            if ($currentItem->options->has('min_quantity') && $quantity < $currentItem->options->min_quantity) {
                $request->session()->flash('error', 'Minimum Order quantity reached.');
                return response()->json(['status' => 403, 'message' => 'Minimun quantity reached']);
            }
        }

        Cart::update($rowId, $quantity);

        $request->session()->flash('success', 'Cart has been updated.');
        return response()->json(['status' => 200]);
    }
}
