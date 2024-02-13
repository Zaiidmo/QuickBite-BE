<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Registration Routes

Route::post('/register', 'App\Http\Controllers\Auth\RegistrationController@store');

//Login Routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('web');

// Forgot password route
Route::post('password/forgot', [ForgotPasswordController::class, 'forgot'])->name('password.forgot');

// Reset password route
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');