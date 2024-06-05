<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\CartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function get_cart() {
        $cart_items = DB::table('products')
        ->select('products.name', 'products.price', 'cart_items.id', 'cart_items.quantity')
        ->join('cart_items', 'products.id','=','cart_items.product_id')
        ->where('user_id', auth()->id())
        ->get();
        
        return view('cart', ['cart_items' => $cart_items]);
    }

    public function add_to_cart(Products $product) {

        $cart_item = CartItems::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        
        if(empty($cart_item)) {
            CartItems::create([
                'user_id' => auth()->id(),
                'product_id'=> $product->id,
                'quantity' => 1
            ]);
        }
        else {
            $cart_item->quantity = $cart_item->quantity + 1;
            $cart_item->save();
        }

        return redirect('/cart')->with('alert', 'Item added to cart successfully!');
    }

    public function update_quantity(Request $request, CartItems $cart_item) {
        $field = $request->validate([
            'quantity' => ['required', 'gte:1']
        ]);

        $cart_item->quantity = $field['quantity'];

        $cart_item->save();

        return redirect('/cart')->with('alert', 'Cart Item Successfully Updated!');
    }

    public function delete_cart_item(CartItems $cart_item) {
        $cart_item->delete();

        return redirect('/cart')->with('alert','Cart Item Deleted Successfully!');
    }

}
