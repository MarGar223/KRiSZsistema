<?php


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteFormController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationFormController;
use App\Http\Controllers\UsersController;

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

Route::get('/rezervacijos/kurti', [ReservationFormController::class, 'index'])->name('createReservation');
Route::post('/rezervacijos/kurti', [ReservationFormController::class, 'createReservation']);

Route::get('/rezervacijos/{reservation}', [ReservationFormController::class, 'showReservation'])->name('showReservation');
Route::post('/rezervacijos/{reservation}/redaguoti', [ReservationFormController::class, 'editReservation'])->name('editReservation');
Route::get('/rezervacijos/{reservation}/trinti', [ReservationFormController::class, 'deleteReservation'])->name('deleteReservation');

Route::get('/rezervacijos/{reservation}/trintiispagrindinio', [ReservationFormController::class, 'deleteReservationFromDashboard'])->name('deleteReservationFromDashboard');
Route::post('/rezervacijos/{reservation}/redaguotiispagrindinio', [ReservationFormController::class, 'editReservationFromDashboard'])->name('editReservationFromDashboard');

Route::get('/uzrasai', [NoteController::class, 'index'])->name('notes');

Route::get('/uzrasai/kurti', [NoteFormController::class, 'index'])->name('createNote');
Route::post('/uzrasai/kurti', [NoteFormController::class, 'createNote']);

Route::get('/usrasai/{note}', [NoteFormController::class, 'showNote'])->name('showNote');
Route::get('/usrasai/{note}/trinti', [NoteFormController::class, 'deleteNote'])->name('deleteNote');
Route::post('/usrasai/{note}/redaguoti', [NoteFormController::class, 'editNote'])->name('editNote');

Route::get('/vartotojai', [UsersController::class, 'index'])->name('allUsers');
Route::get('/vartotojai/{user:name}', [UsersController::class, 'editUser'])->name('editUser');













