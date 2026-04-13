<?php

use App\Http\Controllers\Backend\BookingController;
use App\Http\Controllers\Backend\RuanganController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\JadwalController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ================= FRONTEND =================
Route::get('/', [FrontendController::class, 'index']);
Auth::routes();

// booking (user)
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/create', [UserBookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking', [UserBookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/riwayat', [UserBookingController::class, 'riwayat'])->name('bookings.riwayat');

    Route::get('/ruangan', [UserBookingController::class, 'show'])->name('ruangan.list');
});

// detail ruangan (frontend)
Route::get('/ruangan/{id}', [FrontendController::class, 'ruanganShow'])
    ->name('ruangan.show');

// home
Route::get('/home', [HomeController::class, 'index'])->name('home');


// ================= ADMIN =================
Route::prefix('admin')
    ->name('backend.')
    ->middleware(['auth', Admin::class])
    ->group(function () {

        Route::get('/', [BackendController::class, 'index']);

        Route::resource('user', UserController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('jadwal', JadwalController::class);
        Route::resource('bookings', BookingController::class);

        Route::get('/ruangan/export/pdf', [RuanganController::class, 'exportPdf'])
            ->name('ruangan.export.pdf');

        Route::get('/bookings/export/pdf', [BookingController::class, 'exportPdf'])
            ->name('bookings.export.pdf');
    });