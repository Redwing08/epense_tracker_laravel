<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserAuthController;

// Public Authentication Routes (No login required)
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// Protected Portal Routes (Requires Login First)
Route::middleware(['auth.custom'])->group(function () {
    
    // Dashboard
    Route::get('/', [ExpenseController::class, 'dashboard'])->name('dashboard');

    // Expenses Routes
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // Categories Routes
    Route::get('/categories', [ExpenseController::class, 'categoriesIndex'])->name('categories.index');
    Route::post('/categories', [ExpenseController::class, 'categoriesStore'])->name('categories.store');
    Route::get('/categories/{category}/edit', [ExpenseController::class, 'categoriesEdit'])->name('categories.edit');
    Route::put('/categories/{category}', [ExpenseController::class, 'categoriesUpdate'])->name('categories.update');
    Route::delete('/categories/{id}', [ExpenseController::class, 'categoriesDelete'])->name('categories.destroy');

    // Personnel Directory / User Management Routes
    Route::get('/users', [UserAuthController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserAuthController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserAuthController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserAuthController::class, 'destroy'])->name('users.destroy');
});