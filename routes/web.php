<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkHourController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\OauthController;


Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');

Route::get('/', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/user-login-proses', [AuthController::class, 'userLoginProses'])->name('user.login.proses');

Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

//user
Route::middleware(['user', 'no-cache'])->group(function () {
  Route::get('/dashboard', [PresenceController::class, 'dashboard'])->name('dashboard');
  Route::get('/presensi', [PresenceController::class, 'presenceForm'])->name('presensi');
  Route::post('/presensi-in-store', [PresenceController::class, 'presenceInProses'])->name('presensi-in.store');
  Route::post('/presensi-out-store', [PresenceController::class, 'presenceOutProses'])->name('presensi-out.store');
  Route::post('/clocked_out', [PresenceController::class, 'clocked_out'])->name('clocked_out.user');
  Route::get('/presensi-keluar', [PresenceController::class, 'presenceOutForm'])->name('presensi.out'); // presensi keluar
  Route::get('/riwayat-presensi', [PresenceController::class, 'riwayatPresensi'])->name('riwayat.presensi'); // lihat semua
  Route::get('/akun', [UserController::class, 'profileUser'])->name('profile.user');
  Route::post('/upload-foto', [UserController::class, 'uploadImage'])->name('user.upload.photo');
  Route::post('/akun-proses', [UserController::class, 'updateProfile'])->name('profile.update');
  Route::post('/unlink-google', [UserController::class, 'unlinkGoogle'])->name('unlink.google.user');
  Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout.user');
});


//admin
Route::prefix('admin')->as('admin.')->middleware('admin', 'no-cache')->group(function () {
  Route::get('/profile-admin', [AdminController::class, 'profileAdmin'])->name('profile.admin');
  Route::post('/profile-admin-proses', [AdminController::class, 'updateProfile'])->name('profile.update');
  Route::resource('user', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
  Route::resource('role', RoleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
  Route::resource('work-hour', WorkHourController::class)->only(['index', 'edit', 'update']);
  Route::resource('data-presensi', PresenceController::class)->only(['index']);
  Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');
});
