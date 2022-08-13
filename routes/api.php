<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Backend\CustomerController;
use App\Http\Controllers\Api\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





// test
// Route::post('/login',[TestController::class,'login']);





// backend
// 1)auth routes
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/forgot-password', [Api\Backend\BackendController::class, 'forgot_password'])->name('forgot_password');



// 2)dashboard routes
// Route::apiResource('cities', 'App\Http\Controllers\Api\Backend\CityController');
// Route::apiResource('orders', 'App\Http\Controllers\Api\Backend\OrderController');
// Route::apiResource('products', 'App\Http\Controllers\Api\Backend\ProductController');
// Route::apiResource('customer_addresses', 'App\Http\Controllers\Api\Backend\CustomerAddressController');
// Route::apiResource('countries', 'App\Http\Controllers\Api\Backend\CountryController');
// Route::apiResource('product_categories', 'App\Http\Controllers\Api\Backend\ProductCategoriesController');
// Route::apiResource('tags', 'App\Http\Controllers\Api\Backend\TagController');
// Route::apiResource('product_coupons', 'App\Http\Controllers\Api\Backend\ProductCouponController');
// Route::apiResource('product_reviews', 'App\Http\Controllers\Api\Backend\ProductReviewController');
// Route::apiResource('payment_methods', 'App\Http\Controllers\Api\Backend\PaymentMethodController');
// Route::apiResource('states', 'App\Http\Controllers\Api\Backend\StateController');
// Route::apiResource('shipping_companies', 'App\Http\Controllers\Api\Backend\ShippingCompanyController');

Route::apiResource('customers', 'App\Http\Controllers\Api\Backend\CustomerController');
Route::get('delete/{id}',[CustomerController::class, 'deleteImage']);

Route::apiResource('supervisors', 'App\Http\Controllers\Api\Backend\SupervisorController');


// Route::get('/', [Api\Backend\BackendController::class, 'index'])->name('index_route');
// Route::get('/index', [Api\Backend\BackendController::class, 'index'])->name('index');
// Route::get('/account_settings', [Api\Backend\BackendController::class, 'account_settings'])->name('account_settings');
// Route::post('/admin/remove-image', [Api\Backend\BackendController::class, 'remove_image'])->name('remove_image');
// Route::patch('/account_settings', [Api\Backend\BackendController::class, 'update_account_settings'])->name('update_account_settings');
// Route::post('/product_categories/remove-image', [Api\Backend\ProductCategoriesController::class, 'remove_image'])->name('product_categories.remove_image');
// Route::post('/products/remove-image', [Api\Backend\ProductController::class, 'remove_image'])->name('products.remove_image');
// Route::post('/customers/remove-image', [Api\Backend\CustomerController::class, 'remove_image'])->name('customers.remove_image');
// Route::get('/customers/get_customers', [Api\Backend\CustomerController::class, 'get_customers'])->name('customers.get_customers');
// Route::post('/supervisors/remove-image', [Api\Backend\SupervisorController::class, 'remove_image'])->name('supervisors.remove_image');
// Route::get('states/get_states', [Api\Backend\StateController::class, 'get_states'])->name('states.get_states');
// Route::get('cities/get_cities', [Api\Backend\CityController::class, 'get_cities'])->name('cities.get_cities');





// front end
// auth
Route::post('register',[App\Http\Controllers\Api\Frontend\AuthController::class, 'register']);
Route::post('login',[App\Http\Controllers\Api\Frontend\AuthController::class, 'login']);
Route::post('forget-password',[App\Http\Controllers\Api\Frontend\AuthController::class, 'forgetPassword']);
Route::post('reset-password',[App\Http\Controllers\Api\Frontend\AuthController::class, 'resetPassword']);
Route::post('register-token',[App\Http\Controllers\Api\Frontend\AuthController::class, 'registerToken']);
Route::delete('delete-token',[App\Http\Controllers\Api\Frontend\AuthController::class, 'removeToken']);


// after auth
Route::post('create-order',[App\Http\Controllers\Api\Frontend\MainController::class, 'createOrder'])->middleware('auth:api');
// Route::get('apply-coupon-one',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon'])->middleware('auth:api');
Route::get('apply-coupon',[App\Http\Controllers\Api\Frontend\MainController::class, 'applyCoupon'])->middleware('auth:api');

Route::post('fav-products',[App\Http\Controllers\Api\Frontend\MainController::class, 'favProducts'])->middleware('auth:api');

Route::get('show-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'showCart'])->middleware('auth:api');
Route::delete('delete-cart-product',[App\Http\Controllers\Api\Frontend\MainController::class, 'deleteProduct'])->middleware('auth:api');
Route::put('update-quantity',[App\Http\Controllers\Api\Frontend\MainController::class, 'updateQuantity'])->middleware('auth:api');
Route::post('add-to-cart',[App\Http\Controllers\Api\Frontend\MainController::class, 'addToCart'])->middleware('auth:api');








