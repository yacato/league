<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\PlayMatchController;
use App\Http\Controllers\StandingController;
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

Route::resource('/fixtures', FixtureController::class);
Route::get('/standings', [StandingController::class, 'index']);
Route::post('/play-matches/weekly', [PlayMatchController::class, 'weekly']);
Route::post('/play-matches/all', [PlayMatchController::class, 'all']);
