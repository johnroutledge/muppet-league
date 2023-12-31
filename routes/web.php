<?php

use App\Http\Controllers\GetGameweekController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/scoring', [HomeController::class, 'scoring'])->name('scoring');

Route::middleware(['auth'])->group(function () {
    Route::resource('/user/team', TeamController::class);

    Route::get('/gameweek/{gameweekId}', GetGameweekController::class);
    Route::get('/scores/{gameweek?}', [HomeController::class, 'scores'])->name('scores');
});
