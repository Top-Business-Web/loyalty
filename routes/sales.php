<?php

//use App\Http\Controllers\Admin\CategoryController;
//use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Sales\AdminController;
use App\Http\Controllers\Sales\AuthController;
use App\Http\Controllers\Sales\CartController;
use App\Http\Controllers\Sales\CategoryController;
use App\Http\Controllers\Sales\InvoiceController;
use App\Http\Controllers\Sales\OrderController;
use App\Http\Controllers\Sales\ProductController;
use App\Http\Controllers\Sales\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/change-language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('lang', $locale);
    return back();
});

Route::group(['prefix'=>'sales'],function (){
    Route::get('login', [AuthController::class,'index'])->name('sales');
    Route::POST('login', [AuthController::class,'login'])->name('sales.login');
});

Route::group(['prefix'=>'sales','middleware'=>'auth:user'],function (){
    Route::get('/', function () {
        return view('sales/index');
    })->name('salesHome');

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
    Route::get('add_order',[OrderController::class,'store'])->name('add_order');
    #### orders ####
    Route::get('newOrders',[OrderController::class,'newOrders'])->name('newOrders');
    Route::get('currentOrders',[OrderController::class,'currentOrders'])->name('currentOrders');
    Route::get('endedOrders',[OrderController::class,'endedOrders'])->name('endedOrders');
    Route::get('orderDetails/{id}',[OrderController::class,'orderDetails'])->name('orderDetails');
    Route::get('orderBill/{id}',[OrderController::class,'orderBill'])->name('orderBill');
    Route::POST('orders.delete',[OrderController::class,'destroy'])->name('orders.delete');
    Route::get('get/invoice/order/{id}',[InvoiceController::class,'getInvoice'])->name('admin.get.invoice.order');
    //////////////////////////////////////// orders //////////////////////////////////////////////

    Route::get('cancelneworder','OrderController@cancelneworder')->name('admin.cancelneworder');


    #### Auth ####
    Route::get('logout', [AuthController::class,'logout'])->name('admin.logout');





});

/* cart */
Route::post('cart', [CartController::class,'send_cart'])->name('cart');
Route::get('get_one_cart_/{id}', [CartController::class,'get_one_cart_']);
Route::get('get_cart_', [CartController::class,'get_cart_']);
Route::get('view-cart', [CartController::class,'get_cart'])->name('Get-cart');
Route::get('get_header_cart', [CartController::class,'get_header_cart'])->name('get_header_cart');
Route::post('update_cart', [CartController::class,'update_cart'])->name('update_cart');
Route::get('get_ajax_cart/{id}', [CartController::class,'get_ajax_cart']);
Route::get('delete_cart', [CartController::class,'delete_cart'])->name('delete_cart');
Route::get('cart_table', [CartController::class,'cart_table'])->name('cart_table');
Route::get('show-product', [ProductController::class,'show_product'])->name('show-product');










