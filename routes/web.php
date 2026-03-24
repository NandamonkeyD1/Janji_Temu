<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\BookingAdminController;

// ─── Halaman Utama ────────────────────────────────────────────────────────────
Route::get('/', [ProductController::class, 'home'])->name('home');

// ─── Katalog Produk ───────────────────────────────────────────────────────────
Route::get('/katalog', [ProductController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{product}', [ProductController::class, 'show'])->name('katalog.show');

// ─── Booking ──────────────────────────────────────────────────────────────────
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/sukses', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/slots', [BookingController::class, 'getBookedSlots'])->name('booking.slots');

// ─── Customer Area (Login Required) ──────────────────────────────────────────
Route::prefix('akun')->name('customer.')->middleware('auth')->group(function () {
    Route::get('/booking-saya', [CustomerController::class, 'bookings'])->name('bookings');
});

// ─── Admin Area (Login + Admin Role Required) ─────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductAdminController::class);
    Route::get('bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}/approve', [BookingAdminController::class, 'approve'])->name('bookings.approve');
    Route::patch('bookings/{booking}/reject', [BookingAdminController::class, 'reject'])->name('bookings.reject');
});

// ─── Auth ─────────────────────────────────────────────────────────────────────
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/daftar', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/daftar', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
