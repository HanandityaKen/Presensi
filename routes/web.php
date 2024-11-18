<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');

Route::get('/', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/user-login-proses', [AuthController::class, 'userLoginProses'])->name('user.login.proses');
Route::get('/data-presensi', [AdminController::class, 'dataPresensi'])->name('data.presensi');
Route::get('/jam-kerja', [AdminController::class, 'workHour'])->name('work.hour');

//admin
Route::prefix('admin')->as('admin.')->group(function () {
  Route::resource('user', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
  Route::resource('role', RoleController::class)->only(['index', 'create', 'store', 'destroy']);
});
