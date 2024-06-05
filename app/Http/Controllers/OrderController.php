<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\CartItems;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function get_orders_list() {
        $orders = Orders::where(['created_by' => auth()->id()])->get();

        return view('order_list', ['orders' => $orders]);
    }

    public function place_order() {
        $cart_items = DB::table('products')
        ->select('cart_items.product_id', 'products.name', 'products.price', 'cart_items.quantity')
        ->join('cart_items', 'products.id','=','cart_items.product_id')
        ->where('user_id', auth()->id())
        ->get();

        $total = $cart_items->sum(function ($item) {return $item->price * $item->quantity;});

        $order = Orders::create([
            'total_price' => $total,
            'status' => 'Pending',
            'created_by' => auth()->id(),
            'updated_by' => auth()->id()
        ]);

        foreach ($cart_items as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id'=> $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->price
            ]);
        }

        CartItems::where('user_id', auth()->id())->delete();

        return redirect('/order_list')->with('alert', 'Order placed successfully!');
    }

    public function get_order(Orders $order) {
        $order_items = DB::table('products')
        ->select('products.name', 'order_items.unit_price', 'order_items.quantity')
        ->join('order_items', 'products.id','=','order_items.product_id')
        ->where('order_items.order_id', $order->id)
        ->get();

        return view('order', ['order_items' => $order_items, 'order' => $order]);
    }

    public function update_status(Orders $order) {
        $existing_order = Orders::find($order->id);

        $existing_order->status = 'Received';

        $existing_order->save();

        return redirect('/order/'.strval($order->id))->with('alert', 'Order Received! Thank you for shopping at eShop.com!');
    }
}
