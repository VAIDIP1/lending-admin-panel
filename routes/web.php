<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
