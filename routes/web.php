<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');

Route::get('/', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/user-login-proses', [AuthController::class, 'userLoginProses'])->name('user.login.proses');

Route::get('/data-user', [AdminController::class, 'crudUser'])->name('data.user');
Route::get('/data-presensi', [AdminController::class, 'dataPresensi'])->name('data.presensi');
Route::get('/create-user', [AdminController::class, 'createUserView'])->name('create.user.view');
Route::post('/create-user-proses', [AdminController::class, 'createUser'])->name('create.user');
Route::get('/edit-user', [AdminController::class, 'editUser'])->name('edit.user');
Route::get('/data-role', [AdminController::class, 'crudRole'])->name('data.role.view');
Route::get('/create-role', [AdminController::class, 'createRoleView'])->name('create.role.view');
Route::post('/create-role-proses', [AdminController::class, 'createRole'])->name('create.role');
Route::delete('/delete-role-proses/{id}', [AdminController::class, 'deleteRole'])->name('delete.role');
