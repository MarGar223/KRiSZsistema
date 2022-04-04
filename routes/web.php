<?php


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ZoneSelectController;
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



Route::get('/pagrindinis', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/registracija', [RegisterController::class, 'index'])->name('register');
Route::post('/registracija', [RegisterController::class, 'addUser']);

Route::get('/prisijungti', [LoginController::class, 'index'])->name('auth.login');
Route::post('/prisijungti', [LoginController::class, 'loginUser']);

Route::post('/atsijungti', [LogoutController::class, 'logoutUser'])->name('logout');

Route::get('/rezervacijos', [ReservationController::class, 'index'])->name('reservation');
Route::post('/rezervacijos', [ReservationController::class, 'createReservation']);




