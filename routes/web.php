<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/product-{id}', [ProductController::class, 'show']);
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'userProfile']);
    Route::post('/edit', [AuthController::class, 'editName']);
    Route::post('/editInformation', [AuthController::class, 'editInformation']);
    Route::post('/changePwd', [AuthController::class, 'changePwd']);
    Route::get('/register', [AuthController::class, 'registerPage']);
    Route::post('/register', [AuthController::class, 'register']);
});
