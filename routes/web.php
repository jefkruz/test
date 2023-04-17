<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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

Route::get('clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('storage:link');
    return "Cleared!";

});

Route::get('kc/admin/{token}', [LoginController::class, 'adminLogin'])->name('admin.login');
Route::get('/', [HomeController::class, 'tv'])->name('tv');
Route::post('/', [HomeController::class, 'login'])->name('login');
Route::post('room', [HomeController::class, 'room'])->name('room');
Route::get('test/{room}', [HomeController::class, 'test'])->name('test')->middleware('auth');


Route::get('auth/tv', [HomeController::class, 'authTv'])->name('authTv');
//KINGSCHAT ROUTES
Route::get('kc/{token}', [HomeController::class, 'confirmToken'])->name('confirmToken');

Route::get('tv/logout', [HomeController::class, 'logout'])->name('logout');



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
