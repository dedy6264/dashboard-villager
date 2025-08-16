<?php

Route::get('/makarios/home',function(){
    return view('desaindashboard.slicing.home.index');
})->name('makarios.home');