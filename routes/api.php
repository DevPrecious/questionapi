<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/posts', [PostController::class, 'index'])->name('index');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
