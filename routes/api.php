<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Backend\RuanganController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/ruangan', [RuanganController::class, 'apiIndex']);
    
    Route::get('/ruangan-test', function () {
    try {
        $ruangans = \App\Models\Ruangan::latest()->get();
        return response()->json(['success' => true, 'data' => $ruangans]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
    });
}); 

