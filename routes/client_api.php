<?php

use App\Http\Controllers\Api\Client\Auth\CodeCheckController;
use App\Http\Controllers\Api\Client\Auth\AuthController;
use App\Http\Controllers\Api\Client\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Client\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Client\CategoryController;
use App\Http\Controllers\Api\Client\HomeController;
use App\Http\Controllers\Api\Client\ProductController;
use App\Http\Controllers\Api\Client\ProviderController;
use App\Http\Controllers\Api\Client\ContactController;
use App\Http\Controllers\Api\Client\ClientOrderController;
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

Route::group(['prefix' => 'client/auth'],function (){
    Route::post('password/email',  ForgotPasswordController::class);
    Route::post('password/code/check', CodeCheckController::class);
    Route::post('password/reset', ResetPasswordController::class);
    Route::post('login',[AuthController::class, 'login']);
    Route::POST('register',[AuthController::class, 'register']);
    Route::POST('update-profile',[AuthController::class, 'update_profile']);
    Route::POST('delete-account',[AuthController::class, 'deleteAccount']);
    Route::get('my-profile',[AuthController::class, 'me']);
    Route::POST('contact-us',[ContactController::class, 'store']);

//    Route::post('insert-token',[NotificationController::class, 'insert_token']);
});
Route::group(['prefix' => 'client'],function (){
    Route::get('providers/list', [ProviderController::class, 'index']);
    Route::get('home', [HomeController::class, 'index']);
    Route::get('packages', [HomeController::class, 'packages']);
    Route::get('search', [HomeController::class, 'search']);

});

Route::group(['prefix' => 'client/orders'],function (){
    Route::get('list', [ClientOrderController::class, 'index']);
    Route::post('store', [ClientOrderController::class, 'store']);
//    Route::post('update/{id}', [ProductController::class, 'update']);
    Route::post('delete/{id}', [ClientOrderController::class, 'destroy']);
    Route::post('complete-ordering', [ClientOrderController::class, 'completeOrdering']);
    Route::post('cancel-order', [ClientOrderController::class, 'cancelOrder']);

});

Route::group(['prefix' => 'client'],function (){

    Route::post('add-rate', [HomeController::class, 'add_rate']);

});


Route::group(['prefix' => 'client/products'],function (){
    Route::get('list/{category_id}', [ProductController::class, 'index']);
});



