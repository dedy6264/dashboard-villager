<?php
use App\Http\Controllers\Viller\VillerController;

// Route::middleware('guest')->group(function () {
    Route::get('/viller/login',function(){
        return view('viller/login');
    })->name('viller.login');
    Route::post('/viller/signin',[VillerController::class,'signin'])->name('viller.signin');
    Route::get('/viller/onboarding',function(){
        return view('viller/onboarding/index');
    })->name('viller.onboarding');
    Route::get('/viller/otp',function(){
        return view('viller/onboarding/otp');
    })->name('viller.otp');
    Route::post('/viller/signup',[VillerController::class,'signup'])->name('viller.signup');
    Route::post('/viller/verificationotp',[VillerController::class,'verificationotp'])->name('viller.verificationotp');
    Route::get('/viller/resendotp/{cifId}',[VillerController::class,'resendotp'])->name('viller.resendotp');
// });
// Route::middleware('auth')->group(function () {
    Route::get('/viller/home',[VillerController::class,'index'])->name('viller.home');
    Route::post('/viller/getuser',[VillerController::class,'getuser'])->name('viller.getuser');
    Route::post('/viller/gettrx',[VillerController::class,'gettrx'])->name('viller.gettrx');
    Route::post('/viller/trxdetail',[VillerController::class,'trxdetail'])->name('viller.trxdetail');
    Route::get('/viller/history',[VillerController::class,'history'])->name('viller.history');
    Route::post('/viller/advice',[VillerController::class,'advice'])->name('viller.advice');
    Route::post('/viller/inquiry',[VillerController::class,'inquiry'])->name('viller.inquiry');
    Route::post('/viller/payment',[VillerController::class,'payment'])->name('viller.payment');
    Route::get('/viller/pulsa',[VillerController::class,'pulsa'])->name('viller.pulsa');
    Route::post('/viller/getprefix',[VillerController::class,'getprefix'])->name('viller.getprefix');
    Route::post('/viller/getproductbyreference',[VillerController::class,'getproductbyreference'])->name('viller.getproductbyreference');
    Route::get('/viller/successpaymentpage',function(){
        return view('viller/history/payment');
    })->name('viller.successpaymentpage');
    Route::get('/viller/account',function(){
        return view('viller/account/index');
    })->name('viller.account');
    Route::post('/viller/getsaving',[VillerController::class,'getsaving'])->name('viller.getsaving');
    Route::get('/viller/inquiry/saving',function(){
        return view('viller/onboarding/setpin');
    })->name('viller.inquirysaving');
    Route::post('/viller/confirmaccount',[VillerController::class,'confirmaccount'])->name('viller.confirmaccount');
// });