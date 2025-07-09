<?php

use App\Http\Controllers\Auth\LoginCredentialsController;
use App\Http\Controllers\Auth\RegisterCredentialsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginCredentialsController::class, 'index'])->name('login.index');
Route::post('/login',[LoginCredentialsController::class,'login'])->name('auth.login');
Route::get('/register', [RegisterCredentialsController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterCredentialsController::class, 'store'])->name('register.store');
