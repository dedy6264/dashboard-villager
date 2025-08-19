<?php

Route::get('/makarios/home',function(){
    return view('desaindashboard.slicing.home.index');
})->name('makarios.home');
Route::get('/makarios/categories',function(){
    return view('desaindashboard.slicing.categories.index');
})->name('makarios.categories');