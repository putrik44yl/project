<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controller yang benar
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route test untuk cek apakah user sudah login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});