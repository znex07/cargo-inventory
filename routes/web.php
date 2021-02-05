<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [App\Http\Controllers\CargoController::class, 'search'])->name('search');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add_cargo', [App\Http\Controllers\CargoController::class, 'index'])->name('add_cargo');
Route::post('/view-search', [App\Http\Controllers\CargoController::class, 'view'])->name('view-search');
Route::post('/save_cargo', [App\Http\Controllers\CargoController::class, 'store'])->name('save_cargo');

