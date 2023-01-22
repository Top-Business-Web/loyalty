<?php

//use App\Http\Controllers\Admin\CategoryController;
//use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/change-language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('lang', $locale);
    return back();
});

Route::group(['prefix'=>'admin'],function (){
    Route::get('login', [AuthController::class,'index'])->name('admin.login');
    Route::POST('login', [AuthController::class,'login'])->name('admin.login');
});

Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function (){
    Route::get('/', function () {
        return view('Admin/index');
    })->name('adminHome');

    #### Admins ####
    Route::resource('admins',AdminController::class);
    Route::POST('delete_admin',[AdminController::class,'delete'])->name('delete_admin');
    Route::get('my_profile',[AdminController::class,'myProfile'])->name('myProfile');


    #### Services ####
//    Route::resource('services','ServiceController');
//    Route::post('services.delete','ServiceController@delete')->name('services.delete');

    ################### Setting ###################
    Route::resource('settings',SettingController::class);
    Route::get('setting_about',[SettingController::class,'about'])->name('setting.about');
    Route::post('setting_about_update/{id}',[SettingController::class,'updateabout'])->name('update_about');
    Route::get('setting_terms',[SettingController::class,'terms'])->name('setting.terms');
    Route::post('setting_terms_update/{id}',[SettingController::class,'updateterms'])->name('update_terms');
    Route::get('setting_privacy',[SettingController::class,'privacy'])->name('setting.privacy');
    Route::post('setting_privacy_update/{id}',[SettingController::class,'updateprivacy'])->name('update_privacy');

    ###################### Category #############################
    Route::resource('categories',CategoryController::class);

    ###################### Products #############################
    Route::resource('products',ProductController::class);

    Route::get('category_products/{id}',[ProductController::class,'categoryProducts'])->name('category.products');



    #### Auth ####
    Route::get('logout', [AuthController::class,'logout'])->name('admin.logout');





});










