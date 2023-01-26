<?php

use App\Http\Controllers\Api\Client\Auth\CodeCheckController;
use App\Http\Controllers\Api\Client\Auth\AuthController;
use App\Http\Controllers\Api\Client\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Client\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Client\CategoryController;
use App\Http\Controllers\Api\Client\ProductController;
use App\Http\Controllers\Api\Client\ProviderController;
use App\Http\Controllers\Api\Client\ContactController;
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
Route::group(['prefix' => 'client/providers'],function (){
    Route::get('list', [ProviderController::class, 'index']);

});

Route::group(['prefix' => 'client/products'],function (){
    Route::get('list/{category_id}', [ProductController::class, 'index']);
});




