<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BroadcasterController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'banners'], function () {
    Route::get('/', [BannerController::class, 'index']);
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', [CityController::class, 'index']);
    Route::post('/', [CityController::class, 'store']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::put('/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);
});


Route::group(['prefix' => 'broadcasters'], function () {
    Route::get('/', [\App\Http\Controllers\API\BroadcasterController::class, 'index']);
    Route::post('/', [BroadcasterController::class, 'store']);
    Route::get('/{id}', [BroadcasterController::class, 'show']);
    Route::put('/{id}', [BroadcasterController::class, 'update']);
    Route::delete('/{id}', [BroadcasterController::class, 'destroy']);
});


Route::group(['prefix' => 'users'], function () {
    Route::get('/', [\App\Http\Controllers\API\UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});




Route::apiResource('broadcasters', BroadcasterController::class);
