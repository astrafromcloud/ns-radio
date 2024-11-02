<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BroadcasterController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\SongController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('banners', BannerController::class);

Route::apiResource('cities', CityController::class);

Route::apiResource('broadcasters', BroadcasterController::class);

Route::apiResource('contacts', ContactController::class);

Route::apiResource('songs', SongController::class);

Route::apiResource('users', UserController::class);

Route::apiResource('guests', GuestController::class);

Route::get('/getCity', [CityController::class, 'getCity']);
Route::get('/getWeather', [CityController::class, 'getWeather']);
