<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/recommended', [UserController::class, 'recommended']);
    Route::post('/like/{id}', [UserController::class, 'like']);
    Route::post('/dislike/{id}', [UserController::class, 'dislike']);
    Route::get('/liked', [UserController::class, 'liked']);
});