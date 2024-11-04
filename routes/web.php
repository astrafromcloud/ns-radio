<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome')->name();
//});


Route::get('/admin', function () {
    return redirect()->route('filament.auth.login'); // Redirects to Filament's login page or home page
});
