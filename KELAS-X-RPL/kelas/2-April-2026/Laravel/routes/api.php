<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'storeOrUpdate']);
    
    // Skills (Protected CREATE/DELETE)
    Route::post('/skills', [SkillController::class, 'store']);
    Route::delete('/skills/{id}', [SkillController::class, 'destroy']);
    
    // Portfolio (Protected CREATE/DELETE)
    Route::post('/portfolios', [PortfolioController::class, 'store']);
    Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy']);
});

// Public GET Routes (Portfolio Viewing)
Route::get('/profile/public', [ProfileController::class, 'publicShow']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/portfolios', [PortfolioController::class, 'index']);
