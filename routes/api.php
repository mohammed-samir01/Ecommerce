<?php

use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('verifyAccount','verifyAccount');
    Route::post('forgetPassword','forgetPassword');
    Route::post('updatePassword/{id}','updatePassword');
    Route::post('reset_password', 'resetPassword');
    Route::post('recover', 'recover');
    Route::post('refresh', 'refresh');
    Route::get('user-profile', 'userProfile');
    Route::get('logout', 'logout');


});

//Route::group(['middleware' => ['jwt.auth']], function() {
//    Route::get('logout', 'AuthController@logout');
//
//});



############################################# APi ######################################################################

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


##################################### All Routes | Api Here Must Be Api Authenticated ###################################

################################### Cart,Wishlist  And  Orders ###########################################################

//Route::post('create-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'createOrder'])->middleware('auth:api');
//Route::get('apply-coupon',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon'])->middleware('auth:api');
//Route::post('fav-products',[App\Http\Controllers\Api\Frontend\MainController::class, 'favProducts'])->middleware('auth:api');
//Route::get('show-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'showCart'])->middleware('auth:api');
//Route::delete('delete-cart-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteProduct'])->middleware('auth:api');
//Route::put('update-quantity',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateQuantity'])->middleware('auth:api');
//Route::post('add-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addToCart'])->middleware('auth:api');




Route::group(['middleware' => ['roles', 'role:customer','auth:api']], function () {

    Route::post('create-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'createOrder']);
    Route::get('apply-coupon',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon']);
    Route::post('fav-products',[App\Http\Controllers\Api\Frontend\MainController::class, 'favProducts']);
    Route::get('show-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'showCart']);
    Route::delete('delete-cart-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteProduct']);
    Route::put('update-quantity',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateQuantity']);
    Route::post('add-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addToCart']);

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

