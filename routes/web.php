<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Auth\LoginCredentialsController;
use App\Http\Controllers\Auth\RegisterCredentialsController;
use App\Http\Controllers\UserHomeCOntroller;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginCredentialsController::class, 'index'])->name('login');
Route::post('/login', [LoginCredentialsController::class, 'login'])->name('auth.login');
Route::get('/register', [RegisterCredentialsController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterCredentialsController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginCredentialsController::class, 'logout'])->name('logout');


// Admin-only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
});

// User-only
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [UserHomeCOntroller::class, 'index'])->name('user.dashboard');
});
