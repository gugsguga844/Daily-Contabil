<?php

use App\Controllers\HomeController;
use Core\Router\Route;
use App\Controllers\AuthenticationsController;
use App\Controllers\CategoriesController;
use App\Controllers\ProfileController;
use App\Controllers\SubCategoriesController;
use App\Controllers\TutorialsController;
use App\Controllers\UsersController;

// Login
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {
    // Root
    Route::get('/', [HomeController::class, 'index'])->name('root');

    // Logout
    Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/profile/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('profile.remove');

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/page/{page}', [CategoriesController::class, 'index'])->name('categories.paginate');
    Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('categories.show');

    // SubCategories
    Route::get('/subcategories', [SubCategoriesController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/page/{page}', [SubCategoriesController::class, 'index'])->name('subcategories.paginate');

    // Tutorials
    Route::get('/subcategories', [TutorialsController::class, 'index'])->name('tutorials.index');
    Route::get('/subcategories/show', [TutorialsController::class, 'show'])->name('tutorials.videos');

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

    // SubCategories' CRUD:
        // Create
        Route::get('/subcategories/new', [SubCategoriesController::class, 'new'])->name('subcategories.new');
        Route::post('/subcategories', [SubCategoriesController::class, 'create'])->name('subcategories.create');

        // Delete
        Route::delete('/subcategories', [SubCategoriesController::class, 'destroy'])->name('subcategories.destroy');

    // Tutorials' CRUD:
        // Create
        Route::get('/tutorials/new', [TutorialsController::class, 'new'])->name('tutorials.new');
        Route::post('/tutorials', [TutorialsController::class, 'create'])->name('tutorials.create');
    });
});
