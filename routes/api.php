<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('forgetPassword', 'forgetPassword');
    Route::post('resetPassword', 'resetPassword');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});



############################################# APi ####################################################

Route::get('/all_products',[GeneralController::class,'get_products']);
Route::get('/product/{slug}',[GeneralController::class,'show_product']);
Route::get('/{slug}/related_products',[GeneralController::class ,'related_products']);
Route::get('/all_categories',[GeneralController::class,'get_product_categories']);
Route::get('/featured_products',[GeneralController::class ,'featured_products']);
Route::get('/all_categories_sub',[GeneralController::class ,'shop_tag']);
Route::get('/all_tags',[GeneralController::class ,'tags']);
Route::get('/shop',[GeneralController::class ,'shop']);
Route::get('/shop/{slug?}',[GeneralController::class ,'show_products_with_categories']);
Route::get('/shop/tags/{slug}',[GeneralController::class ,'show_products_with_tags']);





// All Routes | Api Here Must Be Api Authenticated

Route::group(['prefix'=>'user','middleware'=>'api','checkPassword'],function (){

    Route::post('get-main-categories',[CategoriesController::class,'index'])->middleware(['auth.guard:user-api']);
    Route::get('/shop/{slug?}',[FrontendController::class ,'shop'])->name('frontend.shop');
    Route::get('/all_products',[GeneralController::class,'get_products']);
    Route::get('/all_categories',[GeneralController::class,'get_product_categories']);



});





