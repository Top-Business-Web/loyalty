<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Provider\CategoryController;
use App\Http\Controllers\Api\Provider\ProductController;
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

Route::group(['namespace' => 'Api','prefix' => 'auth'],function (){
    Route::post('password/email',  'Auth\ForgotPasswordController');
    Route::post('password/code/check', 'Auth\CodeCheckController');
    Route::post('password/reset', 'Auth\ResetPasswordController');
    Route::post('login',[AuthController::class, 'login']);
    Route::POST('register',[AuthController::class, 'register']);
    Route::POST('update-profile',[AuthController::class, 'update_profile']);
    Route::POST('delete-account',[AuthController::class, 'deleteAccount']);
    Route::get('my-profile',[AuthController::class, 'me']);
//    Route::post('insert-token',[NotificationController::class, 'insert_token']);
});
Route::group(['namespace' => 'Provider','prefix' => 'categories'],function (){
    Route::get('list', [CategoryController::class, 'index']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::post('update/{id}', [CategoryController::class, 'update']);
    Route::post('delete/{id}', [CategoryController::class, 'destroy']);
});

Route::group(['namespace' => 'Provider','prefix' => 'products'],function (){
    Route::get('list', [ProductController::class, 'index']);
    Route::post('store', [ProductController::class, 'store']);
    Route::post('update/{id}', [ProductController::class, 'update']);
    Route::post('delete/{id}', [ProductController::class, 'destroy']);
});


Route::group([ 'middleware' => 'api','namespace' => 'Api'], function () {

});


