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


Route::get('/verified-middleware-example', function () {
    return response()->json([
        'message'=>'MMMMMMMMMMMMMMMMMMMMMMM',
    ]);
})->middleware('auth:sanctum');


Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');

});


############################################# APi ####################################################

Route::get('/all_categories',[GeneralController::class,'get_product_categories']);
Route::get('/all_products',[GeneralController::class,'get_products']);
Route::get('/product/{slug}',[GeneralController::class,'show_product']);
Route::get('/shop/{slug?}',[GeneralController::class ,'shop']);


Route::get('/shoop',[App\Http\Livewire\Frontend\ShopProductsComponent::class ,'render']);























// All Routes | Api Here Must Be Api Authenticated

Route::group(['prefix'=>'user','middleware'=>'api','checkPassword'],function (){

    Route::post('get-main-categories',[CategoriesController::class,'index'])->middleware(['auth.guard:user-api']);
    Route::get('/shop/{slug?}',[FrontendController::class ,'shop'])->name('frontend.shop');
    Route::get('/all_products',[GeneralController::class,'get_products']);
    Route::get('/all_categories',[GeneralController::class,'get_product_categories']);



});

Route::group(['prefix'=>'user',['middleware'=>'api','auth.guard:user-api'],'checkPassword'],function (){

    Route::post('get-main-categories',[CategoriesController::class,'index']);

});

Route::group(['prefix'=>'user'],function (){


});


