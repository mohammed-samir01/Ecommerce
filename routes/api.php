<?php

use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


############################################# APi ######################################################################

                                     ########## General APIS ###########

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');                            //verified
    Route::post('register', 'register');
    Route::post('verifyAccount','verifyAccount');
    Route::post('forgetPassword','forgetPassword');
    Route::post('updatePassword/{id}','updatePassword');
    Route::post('recover','recover');

});


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


                      ############## All Routes | Api Here Must Be Api Authenticated ###################


################################### Cart,Wishlist  And  Orders ###########################################################
Route::group(['middleware' => ['roles', 'role:customer','auth:api']], function () {

    Route::post('create-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'createOrder']);
    Route::get('apply-coupon',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon']);
    Route::get('show-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'showCart']);
    Route::delete('delete-cart-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteProduct']);
    Route::put('update-quantity',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateQuantity']);
    Route::post('add-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addToCart']);
    Route::post('toggle-fav',[App\Http\Controllers\Api\Frontend\MainController::class, 'toggleFav']);
    Route::get('get-fav',[App\Http\Controllers\Api\Frontend\MainController::class, 'getFav']);
    Route::delete('delete-fav-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteFavProduct']);
    Route::post('add-fav-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addFavToCart']);

});


Route::middleware('auth:api')->group(function (){
});



############################################## Dashboard User ############################################################

Route::group(['middleware' => ['roles', 'role:customer','auth:api']], function () {

    Route::get('user-profile',[App\Http\Controllers\Api\Frontend\UserController::class, 'userProfile']);
    Route::patch('update_profile', [App\Http\Controllers\Api\Frontend\UserController::class, 'update_profile']);
    Route::delete('profile/remove-image', [App\Http\Controllers\Api\Frontend\UserController::class, 'remove_profile_image']);

    Route::post('add-user-address',[App\Http\Controllers\Api\Frontend\MainController::class, 'addUserAddress']);
    Route::get('get-user-addresses',[App\Http\Controllers\Api\Frontend\MainController::class, 'getUserAddresses']);
    Route::get('get-user-orders',[App\Http\Controllers\Api\Frontend\MainController::class, 'getUserOrders']);
    Route::delete('delete-user-orders',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteUserOrders']);
    Route::delete('delete-user-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteUserOrder']);


    Route::get('logout', [AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);

});
