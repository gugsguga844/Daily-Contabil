<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;

// Authentication
Route::get('/', [HomeController::class, 'index'])->name('root');

// Login
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');
// Logout
Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');


