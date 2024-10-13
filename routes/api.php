<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'check.blocked'])->group(function () {
	Route::get('/user', [UserController::class, 'getUserInfo']);
	Route::put('/user', [UserController::class, 'update']);
	Route::delete('/user', [UserController::class, 'deleteUser']);
	Route::post('/logout', [LoginController::class, 'logout']);
});;
