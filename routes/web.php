<?php

use App\Http\Controllers\CastController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TopMoviesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class);

Route::get('/top', TopMoviesController::class);

Route::post('/movie/create', [MovieController::class, 'create']);

Route::post('/cast/create', [CastController::class, 'create']);


Route::get('/upload', function () {
    return view('uploadCSV');
});
