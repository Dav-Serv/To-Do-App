<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth.login')->group(function() {
    Route::resource('tasks', TasksController::class)->only('index', 'store', 'show');

    Route::post('/logout', [AuthController::class, 'logout']);
});