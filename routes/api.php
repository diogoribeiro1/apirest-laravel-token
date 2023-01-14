<?php
use App\Http\Controllers\api\DogController;
use App\Http\Controllers\UsersController;

//Route::apiResource('dogs',DogController::class);
//
//Route::apiResource('dogs',DogController::class)
//    ->only(['index'])->middleware('auth:sanctum');


Route::controller(DogController::class)->prefix('dogs')->name('dogs.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{name}/search', 'search')->name('search');
    Route::get('/{id}', 'show')->name('show')->middleware('auth:sanctum');
    Route::post('/', 'store')->name('store')->middleware('auth:sanctum');
    Route::put('/{id}', 'update')->name('update')->middleware('auth:sanctum');
    Route::delete('/{id}', 'destroy')->name('destroy')->middleware('auth:sanctum');
});

Route::controller(UsersController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/refresh', 'refresh')->name('refresh')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});