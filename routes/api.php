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

Route::apiResources([
    'movies' => MovieController::class,
]);

Route::get('/filtered_movies', [MovieController::class, 'filter']);
Route::get('/ordered_movies', [MovieController::class, 'order']);
