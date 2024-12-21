<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;
use App\Controllers\UsersController;

// Login
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {
    // Index
    Route::get('/', [HomeController::class, 'index'])->name('root');

    // Logout
    Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    Route::middleware('admin')->group(function () {
    // Users' CRUD:
        // Create
        Route::get('/users/new', [UsersController::class, 'new'])->name('users.new');
        Route::post('/users', [UsersController::class, 'create'])->name('users.create');

        // Retrieve
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/page/{page}', [UsersController::class, 'index'])->name('users.paginate');
        Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');

        // Update
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');

        // Delete
        Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});