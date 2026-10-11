<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});

// Expense Tracker Routes
// Set Dashboard as the home page
Route::get('/', [ExpenseController::class, 'dashboard'])->name('dashboard');
Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');

// Categories Routes
Route::get('/categories', [ExpenseController::class, 'categoriesIndex'])->name('categories.index');
Route::post('/categories', [ExpenseController::class, 'categoriesStore'])->name('categories.store');
Route::get('/categories/{category}/edit', [ExpenseController::class, 'categoriesEdit'])->name('categories.edit');
Route::put('/categories/{category}', [ExpenseController::class, 'categoriesUpdate'])->name('categories.update');
Route::delete('/categories/{id}', [ExpenseController::class, 'categoriesDelete'])->name('categories.destroy');