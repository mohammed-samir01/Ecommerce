<?php

use App\Http\Controllers\Api\Frontend\ChatController;
use App\Http\Controllers\Api\Frontend\FatoorahController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Api\Frontend\PaymentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Frontend\StripePaymentController;


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


################################### Cart , Wishlist  And  Orders ###########################################################
Route::group(['middleware' => ['roles', 'role:customer','auth:api']], function () {

    Route::get('apply-coupon',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon']);
    Route::get('show-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'showCart']);
    Route::delete('delete-cart-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteProduct']);
    Route::put('update-quantity',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateQuantity']);
    Route::post('add-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addToCart']);
    Route::post('toggle-fav',[App\Http\Controllers\Api\Frontend\MainController::class, 'toggleFav']);
    Route::get('get-fav',[App\Http\Controllers\Api\Frontend\MainController::class, 'getFav']);
    Route::delete('delete-fav-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteFavProduct']);
    Route::post('add-fav-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addFavToCart']);
    Route::get('countries',[App\Http\Controllers\Api\Frontend\MainController::class, 'countries']);
    Route::get('states/{country_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'states']);
    Route::get('cities/{state_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'cities']);
    Route::post('/checkout/payment', [PaymentApiController::class, 'checkout_now'])->name('checkout.payment');
    Route::get('/checkout/{order_id}/cancelled', [PaymentApiController::class, 'cancelled'])->name('checkout.cancelApi');
    Route::get('/checkout/{order_id}/completed', [PaymentApiController::class, 'completed'])->name('checkout.completeApi');
    Route::get('/checkout/webhook/{order?}/{env?}', [PaymentApiController::class, 'webhook'])->name('checkout.webhook.ipn');


});



############################################## Dashboard User ############################################################

Route::group(['middleware' => ['roles', 'role:customer','auth:api']], function () {

    ############################################## Dashboard User ######################################################
    Route::get('user-profile',[App\Http\Controllers\Api\Frontend\UserController::class, 'userProfile']);
    Route::post('update_profile', [App\Http\Controllers\Api\Frontend\UserController::class, 'update_profile']);
    Route::post('update_image_profile', [App\Http\Controllers\Api\Frontend\UserController::class, 'update_profile_image']);
    Route::delete('profile/remove-image', [App\Http\Controllers\Api\Frontend\UserController::class, 'remove_profile_image']);
    Route::post('add-user-address',[App\Http\Controllers\Api\Frontend\MainController::class, 'addUserAddress']);
    Route::delete('delete-user-address/{address_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteUserAddress']);
    Route::get('get-user-addresses',[App\Http\Controllers\Api\Frontend\MainController::class, 'getUserAddresses']);
    Route::get('get-user-address/{address_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'getUserAddress']);
    Route::put('update-user-address/{address_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateUserAddress']);
    Route::get('get-user-orders',[App\Http\Controllers\Api\Frontend\MainController::class, 'getUserOrders']);
    Route::delete('delete-user-orders',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteUserOrders']);
    Route::delete('delete-user-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteUserOrder']);
    Route::get('show-user-order/{order_id}',[App\Http\Controllers\Api\Frontend\MainController::class, 'showUserOrder']);
    Route::get('shipping-compines',[App\Http\Controllers\Api\Frontend\MainController::class, 'shippingCompines']);
    Route::get('payment-methods',[App\Http\Controllers\Api\Frontend\MainController::class, 'paymentMethods']);
    ############################################## End Of Dashboard User ###############################################

    ##################################### Chat #########################################################################
    Route::post('sendmessage',[ChatController::class, 'sendmessage']);
    Route::get('playmessage', [ChatController::class, 'playmessage']);
    Route::post('createchat', [ChatController::class, 'createchat']);
    Route::put('status',      [ChatController::class, 'userStatus']);
    Route::put('typing', function (Request $request) {
        DB::table('chats')
            ->where('user_id', $request->user()->id)
            ->update(['typing' => $request->typing]);
    });
    #################################### End Chat ######################################################################

    ###################################### Logout ######################################################################
    Route::get('logout', [AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);
    ###################################### End Logout ##################################################################


});

############################################# Fatoorah Payment #########################################################
Route::get('callback',[PaymentApiController::class ,'callback']);
Route::get('error',[PaymentApiController::class ,'error']);
############################################# End Fatoorah Payment #####################################################



############################################# For Testing Only ######################################################
############################################# Fatoorah Payment #####################################################
//Route::post('pay',[FatoorahController::class ,'payOrder']);
//Route::get('callback',[FatoorahController::class ,'callback']);
//Route::get('error',[FatoorahController::class ,'error']);
############################################# End Fatoorah Payment #################################################
//Route::get('stripe',[StripePaymentController::class,'stripe']);
//Route::post('stripe',[StripePaymentController::class,'stripePost'])->name('stripe.post');

