<?php

use App\Http\Controllers\CekController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantOutletController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Mobile\MobileLoginController;
use App\Http\Controllers\Mobile\MobileHomeController;
use App\Http\Controllers\Mobile\MobileProductController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/success', function () {
    return view('success');
})->name('success');

// Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');
// Route::get('/dashboard', [CekController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CekController::class,'index'])->name('dashboard');

    Route::get('/cek',[CekController::class,'index'])->name('cek');
    Route::controller(HomeController::class)->group(function () {
        Route::get('/homes', 'index')->name('homes');
        Route::get('/homes/product/{id}', 'product')->name('homes.product');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
        Route::post('/users/getAll', 'getAll')->name('users.getAll');
        Route::post('/users/update', 'update')->name('users.update');
        Route::post('/users/store', 'store')->name('users.store');
        Route::get('/users/destroy/{id}', 'destroy')->name('users.destroy');
    });
    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index')->name('clients');
        Route::post('/clients/getAll', 'getAll')->name('clients.getAll');
        Route::post('/clients/update', 'update')->name('clients.update');
        Route::post('/clients/store', 'store')->name('clients.store');
        Route::get('/clients/destroy/{id}', 'destroy')->name('clients.destroy');
    });
    Route::controller(GroupController::class)->group(function () {
        Route::get('/groups', 'index')->name('groups');
        Route::post('/groups/getAll', 'getAll')->name('groups.getAll');
        Route::post('/groups/update', 'update')->name('groups.update');
        Route::post('/groups/store', 'store')->name('groups.store');
        Route::get('/groups/destroy/{id}', 'destroy')->name('groups.destroy');
    });
    Route::controller(MerchantController::class)->group(function () {
        Route::get('/merchants', 'index')->name('merchants');
        Route::post('/merchants/getAll', 'getAll')->name('merchants.getAll');
        Route::post('/merchants/update', 'update')->name('merchants.update');
        Route::post('/merchants/store', 'store')->name('merchants.store');
        Route::get('/merchants/destroy/{id}', 'destroy')->name('merchants.destroy');
    });
    Route::controller(MerchantOutletController::class)->group(function () {
        Route::get('/merchantOutlets', 'index')->name('merchantOutlets');
        Route::post('/merchantOutlets/getAll', 'getAll')->name('merchantOutlets.getAll');
        Route::post('/merchantOutlets/update', 'update')->name('merchantOutlets.update');
        Route::post('/merchantOutlets/store', 'store')->name('merchantOutlets.store');
        Route::get('/merchantOutlets/destroy/{id}', 'destroy')->name('merchantOutlets.destroy');
    });
    Route::controller(CategoryProductController::class)->group(function () {
        Route::get('/categoryProducts', 'index')->name('categoryProducts');
        Route::post('/categoryProducts/getAll', 'getAll')->name('categoryProducts.getAll');
        Route::post('/categoryProducts/update', 'update')->name('categoryProducts.update');
        Route::post('/categoryProducts/store', 'store')->name('categoryProducts.store');
        Route::get('/categoryProducts/destroy/{id}', 'destroy')->name('categoryProducts.destroy');
    });
    Route::controller(ProductTypeController::class)->group(function () {
        Route::get('/productTypes', 'index')->name('productTypes');
        Route::post('/productTypes/getAll', 'getAll')->name('productTypes.getAll');
        Route::post('/productTypes/update', 'update')->name('productTypes.update');
        Route::post('/productTypes/store', 'store')->name('productTypes.store');
        Route::get('/productTypes/destroy/{id}', 'destroy')->name('productTypes.destroy');
    });
    Route::controller(ProviderController::class)->group(function () {
        Route::get('/providers', 'index')->name('providers');
        Route::post('/providers/getAll', 'getAll')->name('providers.getAll');
        Route::post('/providers/update', 'update')->name('providers.update');
        Route::post('/providers/store', 'store')->name('providers.store');
        Route::get('/providers/destroy/{id}', 'destroy')->name('providers.destroy');
    });
    Route::controller(ProductProviderController::class)->group(function () {
        Route::get('/productProviders', 'index')->name('productProviders');
        Route::post('/productProviders/getAll', 'getAll')->name('productProviders.getAll');
        Route::post('/productProviders/update', 'update')->name('productProviders.update');
        Route::post('/productProviders/store', 'store')->name('productProviders.store');
        Route::get('/productProviders/destroy/{id}', 'destroy')->name('productProviders.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::post('/products/getAll', 'getAll')->name('products.getAll');
        Route::post('/products/update', 'update')->name('products.update');
        Route::post('/products/store', 'store')->name('products.store');
        Route::get('/products/destroy/{id}', 'destroy')->name('products.destroy');
    });
});

Route::get('/m',function(){
    return view('mobile.index');
})->name('m');

Route::get('/h',function(){
    return view('mobile.history');
})->name('h');

Route::get('/u',function(){
    return view('mobile.user');
})->name('u');
Route::get('/l',function(){
    return view('mobile.login');
})->name('l');
Route::get('/pulsa',function(){
    return view('mobile.pulsa');
})->name('pulsa');
Route::get('/payment',function(){
    return view('mobile.payment');
})->name('py');

Route::get('/mobile/login', [MobileLoginController::class,'index'])->name('mobile.login');
Route::post('/mobile/login', [MobileLoginController::class,'mobileLogin'])->name('mobile.login');
Route::get('/mobile/logout', [MobileLoginController::class,'mobileLogout'])->name('mobile.logout');
Route::get('/mobile/loading',function(){return view('mobile.loading');})->name('mobileLoading');
Route::get('/mobile/home', [MobileHomeController::class,'index'])->name('mobile.home');
Route::post('/mobile/validate', [MobileHomeController::class,'userValidate'])->name('mobile.validate');
Route::get('/mobile/pulsa-pra', [MobileProductController::class,'pulsaPrabayar'])->name('mobile.pulsa-pra');
Route::post('/mobile/pulsa-pra/get-product', [MobileProductController::class,'getProduct'])->name('mobile.pulsa-pra.getproduct');
Route::post('/mobile/inquiry', [MobileProductController::class,'inquiry'])->name('mobile.inquiry');
Route::post('/mobile/payment', [MobileProductController::class,'payment'])->name('mobile.payment');

require __DIR__.'/auth.php';
