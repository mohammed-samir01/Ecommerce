<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


###### APi #####################


// All Routes | Api Here Must Be Api Authenticated

Route::group(['middleware'=>'api','checkPassword'],function (){

    Route::post('get-main-categories',[CategoriesController::class,'index']);
    Route::get('/shop/{slug?}',[FrontendController::class ,'shop'])->name('frontend.shop');


});


Route::get('/all_products',[GeneralController::class,'get_products']);
Route::get('/all_categories',[GeneralController::class,'get_product_categories']);


