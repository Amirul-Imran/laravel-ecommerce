<?php

use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    $products = Products::orderByDesc('created_at')->get();
    return view('home', ['products'=> $products]);
});


// User-related Routes
Route::get('/login', function () {return view('login');});

Route::get('/register', function () {return view('register');});

Route::post('/existing-user', [UserController::class,'login']);

Route::post('/new-user', [UserController::class,'register']);

Route::get('/logout', [UserController::class,'logout'])->middleware('auth');


// Product-related Routes
Route::get('/product', function () {return view('product');});

Route::get('/sell', function () {return view('sell');})->middleware('auth');

Route::post('/sell-item', [ProductController::class,'list_item'])->middleware('auth');


//Cart-related Routes
Route::get('/cart', [CartController::class,'get_cart'])->middleware('auth');

Route::post('/add-to-cart/{product}', [CartController::class,'add_to_cart'])->middleware('auth');

Route::put('/update-quantity/{cart_item}', [CartController::class,'update_quantity'])->middleware('auth');

Route::delete('/delete-cart-item/{cart_item}', [CartController::class, 'delete_cart_item'])->middleware('auth');

Route::post('/place-order', [OrderController::class,'place_order'])->middleware('auth');


//Order-related Routes
Route::get('/order_list', [OrderController::class,'get_orders_list'])->middleware('auth');

Route::get('/order/{order}', [OrderController::class,'get_order'])->middleware('auth');

Route::post('/update-status/{order}', [OrderController::class, 'update_status'])->middleware('auth');
