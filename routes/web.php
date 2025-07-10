<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ViewAllTaskController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Auth\LoginCredentialsController;
use App\Http\Controllers\Auth\RegisterCredentialsController;
use App\Http\Controllers\TaskController;
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
    Route::get('/admin/view-all-task', [ViewAllTaskController::class, 'index'])->name('all.task.index');
    Route::get('/admin/user-manage', [UserManagementController::class, 'index'])->name('user.manage.index');
});

// User-only
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [UserHomeCOntroller::class, 'index'])->name('user.dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});
