<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BroadcasterController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\SongController;
use App\Http\Controllers\API\AuthController;
use App\Models\Contact;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/banners', BannerController::class);

//Route::get('/cities', function (Request $request) {
Route::apiResource('cities', CityController::class)->middleware([\App\Http\Middleware\SetLocale::class]);
//});

Route::apiResource('broadcasters', BroadcasterController::class)->middleware([\App\Http\Middleware\SetLocale::class]);
//
Route::get('/contacts', function () {
    return new \App\Http\Resources\ContactResource(Contact::all());
});

Route::apiResource('songs', SongController::class);

Route::apiResource('users', AuthController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/getUserByToken', [AuthController::class, 'getUserByToken']);


Route::apiResource('guests', GuestController::class);

Route::get('/getCity', [CityController::class, 'getCity']);
Route::get('/getWeather', [CityController::class, 'getWeather']);

Route::get('/programs', function (Request $request) {
    return new \App\Http\Resources\ProgramResource(Program::all());
});

Route::get('/banners', function (Request $request) {
    return new \App\Http\Resources\BannerResource(\App\Models\Banner::all());
});

