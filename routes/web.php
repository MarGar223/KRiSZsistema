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
use App\Http\Controllers\ReservationFilterController;
use App\Http\Controllers\NoteFilterController;
use App\Http\Controllers\UserFilterController;
use App\Models\Reservation;
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

Route::post('/registracija', [RegisterController::class, 'addUser'])->name('register');

Route::get('/prisijungti', [LoginController::class, 'index'])->name('auth.login');
Route::post('/prisijungti', [LoginController::class, 'loginUser']);

Route::post('/atsijungti', [LogoutController::class, 'logoutUser'])->name('logout');

Route::get('/rezervacijos', [ReservationController::class, 'index'])->name('reservation');
Route::get('/rezervacijos/filtras', [ReservationFilterController::class, 'index'])->name('filterReservation');

Route::post('/rezervacijos/kurti', [ReservationFormController::class, 'createReservation'])->name('createReservation');

Route::post('/rezervacijos/{reservation}/redaguoti', [ReservationFormController::class, 'editReservation'])->name('editReservation');
Route::get('/rezervacijos/{reservation}/trinti', [ReservationFormController::class, 'deleteReservation'])->name('deleteReservation');

Route::get('/rezervacijos/{reservation}/trintiispagrindinio', [ReservationFormController::class, 'deleteReservationFromDashboard'])->name('deleteReservationFromDashboard');
Route::post('/rezervacijos/{reservation}/redaguotiispagrindinio', [ReservationFormController::class, 'editReservationFromDashboard'])->name('editReservationFromDashboard');

Route::get('/uzrasai', [NoteController::class, 'index'])->name('notes');
Route::get('/uzrasai/filtras', [NoteFilterController::class, 'index'])->name('filterNotes');

Route::post('/uzrasai/kurti', [NoteFormController::class, 'createNote'])->name('createNote');

Route::get('/usrasai/{note}/trinti', [NoteFormController::class, 'deleteNote'])->name('deleteNote');
Route::post('/usrasai/{note}/redaguoti', [NoteFormController::class, 'editNote'])->name('editNote');

Route::get('/vartotojai', [UsersController::class, 'index'])->name('allUsers');
Route::get('/vartotojai/filtras', [UserFilterController::class, 'index'])->name('filterUsers');

Route::post('/vartotojai/{user:name}', [UsersController::class, 'editUser'])->name('editUser');
Route::get('/vartotojai/{user}/trinti', [UsersController::class, 'deleteUser'])->name('deleteUser');

Route::get('/usrasai/{note}/trintiispagrindinio', [NoteFormController::class, 'deleteNoteFromDashboard'])->name('deleteNoteFromDashboard');
Route::post('/usrasai/{note}/redaguotiispagrindinio', [NoteFormController::class, 'editNoteFromDashboard'])->name('editNoteFromDashboard');

// Route::get('/test', function(){
//     return view('testMap');
// });



// Route::get('/test', [ReservationController::class, 'ajaxTest']);
Route::resource('/test', ReservationController::class);
Route::post('/test/post', [ReservationController::class, 'addAjax']);



// Route::get('/test/show', [CalendarController::class, 'showReservations'])->name('calshow');










