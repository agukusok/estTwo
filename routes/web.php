<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\UserController;

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
	Route::get('/user', [UserController::class, 'getUserInfo'])->name('user.profile');
	Route::put('/user', [UserController::class, 'update'])->name('user.update');
	Route::delete('/user', [UserController::class, 'deleteUser'])->name('user.delete');
});
