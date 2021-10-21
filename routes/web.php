<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('news', [NewsController::class, 'index']);
Route::post('news', [NewsController::class, 'store']);
Route::get('news/detail', [NewsController::class, 'show']);
Route::delete('news', [NewsController::class, 'destroy']);
Route::put('news', [NewsController::class, 'update']);
