<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

Route::get('movies', [MovieController::class, 'index'])->name('movies');
Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movie');
Route::post('movies', [MovieController::class, 'store'])->name('store');
Route::put('movies/{movie}', [MovieController::class, 'update'])->name('update');
Route::delete('movies/{movie}', [MovieController::class, 'destroy'])->name('delete');

Route::get('filtered_movies', [MovieController::class, 'filter'])->name('filter');
Route::get('ordered_movies', [MovieController::class, 'order'])->name('order');
