<?php

use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\Provider\Auth\AuthController;
use App\Http\Controllers\Api\Provider\Auth\CodeCheckController;
use App\Http\Controllers\Api\Provider\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Provider\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Provider\CategoryController;
use App\Http\Controllers\Api\Provider\OrderController;
use App\Http\Controllers\Api\Provider\ProductController;
use App\Http\Controllers\Api\Provider\SearchController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PaytapsPaymentController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

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

Route::group(['prefix' => 'provider/auth'],function (){
    Route::post('password/email',  ForgotPasswordController::class);
    Route::post('password/code/check', CodeCheckController::class);
    Route::post('password/reset', ResetPasswordController::class);
    Route::post('login',[AuthController::class, 'login']);
    Route::POST('register',[AuthController::class, 'register']);
    Route::POST('update-profile',[AuthController::class, 'update_profile']);
    Route::POST('delete-account',[AuthController::class, 'deleteAccount']);
    Route::get('my-profile',[AuthController::class, 'me']);
    Route::get('profile-by-phone',[AuthController::class, 'profileWithPhone']);
//    Route::post('insert-token',[NotificationController::class, 'insert_token']);
});
Route::group(['prefix' => 'provider/categories'],function (){
    Route::get('list', [CategoryController::class, 'index']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::get('find/{id}', [CategoryController::class, 'find']);
    Route::post('update/{id}', [CategoryController::class, 'update']);
    Route::post('delete/{id}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'provider/products'],function (){
    Route::get('list/{category_id}', [ProductController::class, 'index']);
    Route::post('store', [ProductController::class, 'store']);
    Route::get('find/{id}', [ProductController::class, 'find']);
    Route::post('update/{id}', [ProductController::class, 'update']);
    Route::post('delete/{id}', [ProductController::class, 'destroy']);
});

Route::group(['prefix' => 'provider/orders'],function (){
    Route::get('list', [OrderController::class, 'index']);
    Route::post('store', [OrderController::class, 'store']);
//    Route::post('update/{id}', [ProductController::class, 'update']);
    Route::post('delete/{id}', [OrderController::class, 'destroy']);
    Route::post('complete-ordering', [OrderController::class, 'completeOrdering']);
    Route::post('cancel-order', [OrderController::class, 'cancelOrder']);

});

Orion::resource('products-api', ProductsController::class);


Route::group([ 'middleware' => 'api','namespace' => 'Api'], function () {
    Route::get('setting',[SettingController::class, 'index']);
    Route::get('/paytap/store',[PaytapsPaymentController::class,'store'])->name('paytap');
    Route::get('/callback_paytabs',[PaytapsPaymentController::class,'callback_paytabs']);
    Route::post('/return_paytabs',[PaytapsPaymentController::class,'return_paytabs']);
    Route::get('/search', [SearchController::class, 'index']);
});



