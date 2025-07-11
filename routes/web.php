<?php

use App\Http\Controllers\Admin\TaskAssignController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ViewAllTaskController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Auth\LoginCredentialsController;
use App\Http\Controllers\Auth\RegisterCredentialsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserHomeCOntroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

// Show login page
Route::get('/', [LoginCredentialsController::class, 'index'])->name('login');

// Handle login form submission
Route::post('/login', [LoginCredentialsController::class, 'login'])->name('auth.login');

// Show registration form
Route::get('/register', [RegisterCredentialsController::class, 'index'])->name('register.index');

// Handle registration form submission
Route::post('/register', [RegisterCredentialsController::class, 'store'])->name('register.store');

// Handle logout
Route::post('/logout', [LoginCredentialsController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes (Requires admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin dashboard view
    Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');

    // View all tasks
    Route::get('/admin/view-all-task', [ViewAllTaskController::class, 'index'])->name('all.task.index');

    // AJAX search for tasks
    Route::get('/admin/tasks/search', [ViewAllTaskController::class, 'search']);

    // Delete a task
    Route::delete('/task/delete/{id}', [ViewAllTaskController::class, 'destroy'])->name('task.destroy');

    // User management list page
    Route::get('/admin/user-manage', [UserManagementController::class, 'index'])->name('user.manage.index');

    // Toggle user active/inactive status
    Route::post('/admin/user/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('admin.user.toggleStatus');

    // Task assignment form
    Route::get('/admin/task/assign', [TaskAssignController::class, 'index'])->name('admin.task.assign');

    // Edit task assignment
    Route::get('/admin/task/{id}/edit', [TaskAssignController::class, 'edit'])->name('admin.task.edit');

    // Update task assignment
    Route::post('/admin/task/{id}/update', [TaskAssignController::class, 'update'])->name('admin.task.update');

    // Store new task assignment
    Route::post('/admin/task/assign', [TaskAssignController::class, 'store'])->name('admin.assign.task');
});


/*
|--------------------------------------------------------------------------
| User Routes (Requires user role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {

    // User dashboard
    Route::get('/user/dashboard', [UserHomeCOntroller::class, 'index'])->name('user.dashboard');

    // View tasks assigned to the user
    Route::get('/my-tasks', [TaskController::class, 'index'])->name('my.tasks.index');

    // Update task status (via AJAX)
    Route::post('/user/task/update-status/{id}', [TaskController::class, 'updateStatus'])->name('user.task.updateStatus');
});
