<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {
    Route::post('/create', [UserController::class, 'store']);

    Route::middleware(['auth:sanctum'])->get('/', function (Request $request) {
        return $request->user();
    });

    Route::get('email-verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('room')->group(function () {
        Route::post('/create', [RoomController::class, 'store'])->name('room.create');
    });
});

Route::post('/auth/login', [AuthController::class, 'store'])->middleware('guest');
