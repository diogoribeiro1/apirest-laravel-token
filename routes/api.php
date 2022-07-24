<?php
use App\Http\Controllers\api\DogController;
use App\Http\Controllers\UsersController;

Route::apiResource('dogs',DogController::class);

Route::apiResource('dogs',DogController::class)
    ->only(['index'])->middleware('auth:sanctum');

Route::controller(UsersController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/refresh', 'refresh')->name('refresh')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});

//Route::prefix('auth')->group(function (){
//    Route::post('login',
//    [\App\Http\Controllers\UsersController::class, 'login']);
//
//    Route::post('logout',
//        [\App\Http\Controllers\UsersController::class, 'logout']);
//
//    Route::post('register',
//        [\App\Http\Controllers\UsersController::class, 'register']);
//});


