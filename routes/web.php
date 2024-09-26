<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/register',[RegisterController::class, 'index']);