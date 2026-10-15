<?php
    use App\Http\Controllers\UserAuthController;
    use App\Http\Controllers\ExpenseController;

    // Mobile Authentication Endpoints
    Route::post('/login', [UserAuthController::class, 'apiLogin']);
    Route::post('/register', [UserAuthController::class, 'apiRegister']);

    // Protected Mobile Financial / Personnel Data
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/expenses', [ExpenseController::class, 'apiIndex']);
        Route::post('/expenses', [ExpenseController::class, 'apiStore']);
        Route::get('/users', [UserAuthController::class, 'apiIndex']);
    });

    // Binary Avatar Image Streaming Endpoint (crucial for BLOB storage!)
    Route::get('/users/{id}/avatar', [UserAuthController::class, 'getAvatarBlob']);