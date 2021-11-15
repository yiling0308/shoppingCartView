<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SubscriberController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'product'
], function ($router) {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/add', [ProductController::class, 'store']);
    Route::post('/delete', [ProductController::class, 'destroy']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::get('/detail', [ProductController::class, 'show']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function ($router) {
    Route::post('/buy', [OrderController::class, 'buy']);
    Route::post('/find', [OrderController::class, 'findOrder']);
});

Route::post('/publish', [PublisherController::class, 'publish']);
Route::get('/pull', [SubscriberController::class, 'pull']);
