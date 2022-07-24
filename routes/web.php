<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\UsersController;

Route::get('/', [UsersController::class, 'getProf'])->name('principal');

