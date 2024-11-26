<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkHourController;
use App\Http\Controllers\PresenceController;


Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');

Route::get('/', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/user-login-proses', [AuthController::class, 'userLoginProses'])->name('user.login.proses');



//user
Route::middleware(['user'])->group(function () {
  Route::get('/dashboard', [PresenceController::class, 'dashboard'])->name('dashboard');
  Route::get('/presensi', [PresenceController::class, 'presenceForm'])->name('presensi');
  Route::post('/presensi-store', [PresenceController::class, 'presenceProses'])->name('presensi.store');
  Route::post('/clocked_out', [PresenceController::class, 'clocked_out'])->name('clocked_out.user');
  Route::get('/presensi-keluar', [PresenceController::class, 'presenceOut'])->name('presensi.out'); // presensi keluar
  Route::get('/riwayat-presensi', [PresenceController::class, 'riwayatPresensi'])->name('riwayat.presensi'); // lihat semua
  Route::get('/akun', [UserController::class, 'profileUser'])->name('profile.user');
  Route::post('/akun-proses', [UserController::class, 'updateProfile'])->name('profile.update');
  Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout.user');
});


//admin
Route::prefix('admin')->as('admin.')->middleware('admin')->group(function () {
  Route::get('/profile-admin', [AdminController::class, 'profileAdmin'])->name('profile.admin');
  Route::post('/profile-admin-proses', [AdminController::class, 'updateProfile'])->name('profile.update');
  Route::resource('user', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
  Route::resource('role', RoleController::class)->only(['index', 'create', 'store', 'destroy']);
  Route::resource('work-hour', WorkHourController::class)->only(['index', 'edit', 'update']);
  Route::resource('data-presensi', PresenceController::class)->only(['index']);
  Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');
});
