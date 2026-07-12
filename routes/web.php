<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ConsultationMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// =====================================================
//  AUTH ROUTES (hanya untuk tamu / belum login)
// =====================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// routes/web.php — middleware yang mengontrol akses, bukan folder controller

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('bookings', BookingController::class);
    Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::resource('consultations', ConsultationController::class)->only(['index', 'show']);
    Route::resource('users', UserController::class)->except(['show']);
    // AJAX: Get doctor schedules for admin booking create/edit forms
    Route::get('/doctors/{doctor}/schedules', [BookingController::class, 'getSchedules'])->name('doctors.schedules');
    // Route::resource('transactions',   TransactionController::class);
    Route::get('/member/profile', [App\Http\Controllers\MemberController::class, 'show'])->name('member.profile.show');
    Route::get('/member/profile/edit', [App\Http\Controllers\MemberController::class, 'edit'])->name('member.profile.edit');
    Route::put('/member/profile/update', [App\Http\Controllers\MemberController::class, 'update'])->name('member.profile.update');
});

// Doctor
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/home', [HomeController::class, 'doctorHome'])->name('home');
    Route::resource('bookings', BookingController::class)->only(['index', 'show']);
    Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::resource('consultations', ConsultationController::class)->only(['index', 'show', 'update']);
    Route::get('/history', [ConsultationController::class, 'history'])->name('history.index'); // ← riwayat
    Route::get('/profile', [ProfileController::class, 'doctorShow'])->name('profile.show');    // ← profil
    Route::get('/profile/edit', [ProfileController::class, 'doctorEdit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'doctorUpdate'])->name('profile.update');
});

// Member
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/home', [HomeController::class, 'memberHome'])->name('home');
    Route::resource('articles', ArticleController::class)->only(['index', 'show']);
    Route::resource('doctors', DoctorController::class)->only(['index', 'show']);
    Route::resource('booking', BookingController::class);
    Route::resource('consultations', ConsultationController::class)->only(['index', 'show', 'store']);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // AJAX: Get doctor schedules for the dynamic booking form
    Route::get('/doctors/{doctor}/schedules', [BookingController::class, 'getSchedules'])->name('doctors.schedules');
});

// =====================================================
//  SHARED AJAX ROUTES — Consultation Messages
//  (accessible by both member and doctor roles)
// =====================================================
Route::middleware('auth')->group(function () {
    // Fetch all messages for a consultation (AJAX polling)
    Route::get('/consultations/{consultation}/messages', [ConsultationMessageController::class, 'index'])
        ->name('consultation-messages.index');

    // Send a new message to a consultation (AJAX)
    Route::post('/consultations/{consultation}/messages', [ConsultationMessageController::class, 'store'])
        ->name('consultation-messages.store');
});
