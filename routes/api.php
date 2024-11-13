<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BroadcasterController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\SongController;
use App\Http\Controllers\API\UserController;
use App\Models\Contact;
use App\Models\Guest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('users', AuthController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('/banners', BannerController::class);
Route::get('/banners', function (Request $request) {
    return new \App\Http\Resources\BannerResource(\App\Models\Banner::where('is_active', 1)->orderBy('order')->get());
});

//Route::get('/cities', function (Request $request) {
Route::apiResource('cities', CityController::class)->middleware([\App\Http\Middleware\SetLocale::class]);
//});

Route::get('/broadcasters', [BroadcasterController::class, 'index']);

Route::get('/contacts', function () {
    return new \App\Http\Resources\ContactResource(Contact::all());
});

Route::apiResource('songs', SongController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::POST('/get-user-by-email', [UserController::class, 'getByEmail']);
Route::post('/getUserByToken', [AuthController::class, 'getUserByToken']);
Route::get('/guests/{id}', [GuestController::class, 'show']);
Route::get('/guests', function (Request $request) {
    return new \App\Http\Resources\GuestResource(Guest::all());
});

Route::get('/getCity', [CityController::class, 'getCity']);
Route::get('/getWeather', [CityController::class, 'getWeather']);

Route::get('/programs', function (Request $request) {
    return new \App\Http\Resources\ProgramResource(Program::all());
});

Route::apiResource('liveTranslations', \App\Http\Controllers\API\LiveTranslationController::class);

Route::post('/leads', [LeadController::class, 'store']);


Route::get('/service-login', [AuthController::class, 'authenticate']);
