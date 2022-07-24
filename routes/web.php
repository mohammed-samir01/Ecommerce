<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;





Route::get('/',[FrontendController::class ,'index'])->name('frontend.index');
Route::get('/cart',[FrontendController::class ,'cart'])->name('frontend.cart');
Route::get('/checkout',[FrontendController::class ,'checkout'])->name('frontend.checkout');
Route::get('/detail',[FrontendController::class ,'detail'])->name('frontend.detail');
Route::get('/shop',[FrontendController::class ,'shop'])->name('frontend.shop');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
