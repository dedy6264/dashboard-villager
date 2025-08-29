<?php
use App\Http\Controllers\Makarios\MakariosController;
use App\Http\Controllers\Makarios\ProductController;
use App\Http\Controllers\Makarios\SavingController;
use App\Http\Controllers\Makarios\TransactionController;

    Route::get('/makarios/client',[MakariosController::class,'client'])->name('makarios.client');
    Route::post('/makarios/getdataclient',[MakariosController::class,'getdataclient'])->name('makarios.getdataclient');
    Route::post('/makarios/adddataclient',[MakariosController::class,'adddataclient'])->name('makarios.adddataclient');
    Route::post('/makarios/updatedataclient',[MakariosController::class,'updatedataclient'])->name('makarios.updatedataclient');
    Route::get('/makarios/deletedataclient/{id}',[MakariosController::class,'deletedataclient'])->name('makarios.deletedataclient');
   
    Route::get('/makarios/group',[MakariosController::class,'group'])->name('makarios.group');
    Route::post('/makarios/getdatagroup',[MakariosController::class,'getdatagroup'])->name('makarios.getdatagroup');
    Route::post('/makarios/adddatagroup',[MakariosController::class,'adddatagroup'])->name('makarios.adddatagroup');
    Route::post('/makarios/updatedatagroup',[MakariosController::class,'updatedatagroup'])->name('makarios.updatedatagroup');
    Route::get('/makarios/deletedatagroup/{id}',[MakariosController::class,'deletedatagroup'])->name('makarios.deletedatagroup');
   
    Route::get('/makarios/merchant',[MakariosController::class,'merchant'])->name('makarios.merchant');
    Route::post('/makarios/getdatamerchant',[MakariosController::class,'getdatamerchant'])->name('makarios.getdatamerchant');
    Route::post('/makarios/adddatamerchant',[MakariosController::class,'adddatamerchant'])->name('makarios.adddatamerchant');
    Route::post('/makarios/updatedatamerchant',[MakariosController::class,'updatedatamerchant'])->name('makarios.updatedatamerchant');
    Route::get('/makarios/deletedatamerchant/{id}',[MakariosController::class,'deletedatamerchant'])->name('makarios.deletedatamerchant');
   
    Route::get('/makarios/merchantoutlet',[MakariosController::class,'merchantoutlet'])->name('makarios.merchantoutlet');
    Route::post('/makarios/getdatamerchantoutlet',[MakariosController::class,'getdatamerchantoutlet'])->name('makarios.getdatamerchantoutlet');
    Route::post('/makarios/adddatamerchantoutlet',[MakariosController::class,'adddatamerchantoutlet'])->name('makarios.adddatamerchantoutlet');
    Route::post('/makarios/updatedatamerchantoutlet',[MakariosController::class,'updatedatamerchantoutlet'])->name('makarios.updatedatamerchantoutlet');
    Route::get('/makarios/deletedatamerchantoutlet/{id}',[MakariosController::class,'deletedatamerchantoutlet'])->name('makarios.deletedatamerchantoutlet');
   
    Route::get('/makarios/producttype',[ProductController::class,'producttype'])->name('makarios.producttype');
    Route::post('/makarios/getdataproducttype',[ProductController::class,'getdataproducttype'])->name('makarios.getdataproducttype');
    Route::post('/makarios/adddataproducttype',[ProductController::class,'adddataproducttype'])->name('makarios.adddataproducttype');
    Route::post('/makarios/updatedataproducttype',[ProductController::class,'updatedataproducttype'])->name('makarios.updatedataproducttype');
    Route::get('/makarios/deletedataproducttype/{id}',[ProductController::class,'deletedataproducttype'])->name('makarios.deletedataproducttype');
   
    Route::get('/makarios/productcategory',[ProductController::class,'productcategory'])->name('makarios.productcategory');
    Route::post('/makarios/getdataproductcategory',[ProductController::class,'getdataproductcategory'])->name('makarios.getdataproductcategory');
    Route::post('/makarios/adddataproductcategory',[ProductController::class,'adddataproductcategory'])->name('makarios.adddataproductcategory');
    Route::post('/makarios/updatedataproductcategory',[ProductController::class,'updatedataproductcategory'])->name('makarios.updatedataproductcategory');
    Route::get('/makarios/deletedataproductcategory/{id}',[ProductController::class,'deletedataproductcategory'])->name('makarios.deletedataproductcategory');
   
    Route::get('/makarios/product',[ProductController::class,'product'])->name('makarios.product');
    Route::post('/makarios/getdataproduct',[ProductController::class,'getdataproduct'])->name('makarios.getdataproduct');
    Route::post('/makarios/adddataproduct',[ProductController::class,'adddataproduct'])->name('makarios.adddataproduct');
    Route::post('/makarios/updatedataproduct',[ProductController::class,'updatedataproduct'])->name('makarios.updatedataproduct');
    Route::get('/makarios/deletedataproduct/{id}',[ProductController::class,'deletedataproduct'])->name('makarios.deletedataproduct');
   
    Route::get('/makarios/provider',[ProductController::class,'provider'])->name('makarios.provider');
    Route::post('/makarios/getdataprovider',[ProductController::class,'getdataprovider'])->name('makarios.getdataprovider');
    Route::post('/makarios/adddataprovider',[ProductController::class,'adddataprovider'])->name('makarios.adddataprovider');   
    Route::post('/makarios/updatedataprovider',[ProductController::class,'updatedataprovider'])->name('makarios.updatedataprovider');
    Route::get('/makarios/deletedataprovider/{id}',[ProductController::class,'deletedataprovider'])->name('makarios.deletedataprovider');
   
    Route::get('/makarios/productprovider',[ProductController::class,'productprovider'])->name('makarios.productprovider');
    Route::post('/makarios/getdataproductprovider',[ProductController::class,'getdataproductprovider'])->name('makarios.getdataproductprovider');
    Route::post('/makarios/adddataproductprovider',[ProductController::class,'adddataproductprovider'])->name('makarios.adddataproductprovider');   
    Route::post('/makarios/updatedataproductprovider',[ProductController::class,'updatedataproductprovider'])->name('makarios.updatedataproductprovider');
    Route::get('/makarios/deletedataproductprovider/{id}',[ProductController::class,'deletedataproductprovider'])->name('makarios.deletedataproductprovider');
   
    Route::get('/makarios/segment',[ProductController::class,'segment'])->name('makarios.segment');
    Route::post('/makarios/getdatasegment',[ProductController::class,'getdatasegment'])->name('makarios.getdatasegment');
    Route::post('/makarios/adddatasegment',[ProductController::class,'adddatasegment'])->name('makarios.adddatasegment');   
    Route::post('/makarios/updatedatasegment',[ProductController::class,'updatedatasegment'])->name('makarios.updatedatasegment');
    Route::get('/makarios/deletedatasegment/{id}',[ProductController::class,'deletedatasegment'])->name('makarios.deletedatasegment');
    
    Route::get('/makarios/productsegment',[ProductController::class,'productsegment'])->name('makarios.productsegment');
    Route::post('/makarios/getdataproductsegment',[ProductController::class,'getdataproductsegment'])->name('makarios.getdataproductsegment');
    Route::post('/makarios/adddataproductsegment',[ProductController::class,'adddataproductsegment'])->name('makarios.adddataproductsegment');   
    Route::post('/makarios/updatedataproductsegment',[ProductController::class,'updatedataproductsegment'])->name('makarios.updatedataproductsegment');
    Route::get('/makarios/deletedataproductsegment/{id}',[ProductController::class,'deletedataproductsegment'])->name('makarios.deletedataproductsegment');
    
    Route::post('/makarios/getdataproductproviderjson',[ProductController::class,'getdataproductproviderjson'])->name('makarios.getdataproductproviderjson');
    Route::post('/makarios/getdatagroupjson',[MakariosController::class,'getdatagroupjson'])->name('makarios.getdatagroupjson');
    Route::post('/makarios/getdatamerchantjson',[MakariosController::class,'getdatamerchantjson'])->name('makarios.getdatamerchantjson');

    Route::get('/makarios/account',[SavingController::class,'account'])->name('makarios.account');
    Route::post('/makarios/getdataaccount',[SavingController::class,'getdataaccount'])->name('makarios.getdataaccount');
    Route::post('/makarios/adddataaccount',[SavingController::class,'adddataaccount'])->name('makarios.adddataaccount');   
    Route::post('/makarios/updatedataaccount',[SavingController::class,'updatedataaccount'])->name('makarios.updatedataaccount');
    Route::get('/makarios/deletedataaccount/{id}',[SavingController::class,'deletedataaccount'])->name('makarios.deletedataaccount');
   
    Route::get('/makarios/savingaccount',[SavingController::class,'savingaccount'])->name('makarios.savingaccount');
    Route::post('/makarios/getdatasavingaccount',[SavingController::class,'getdatasavingaccount'])->name('makarios.getdatasavingaccount');
    Route::post('/makarios/adddatasavingaccount',[SavingController::class,'adddatasavingaccount'])->name('makarios.adddatasavingaccount');   
    Route::post('/makarios/updatedatasavingaccount',[SavingController::class,'updatedatasavingaccount'])->name('makarios.updatedatasavingaccount');
    Route::get('/makarios/deletedatasavingaccount/{id}',[SavingController::class,'deletedatasavingaccount'])->name('makarios.deletedatasavingaccount');
    
    Route::get('/makarios/historytransaction',[TransactionController::class,'historytransaction'])->name('makarios.historytransaction');
    Route::post('/makarios/getdatatransaction',[TransactionController::class,'getdatatransaction'])->name('makarios.getdatatransaction');