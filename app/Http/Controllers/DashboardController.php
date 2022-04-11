<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user){
            $reservations = Reservation::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'rezervacijos');
            $notes = Note::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'uzrasai');


            return view('dashboard', [
                'user' => $user,
                'reservations' => $reservations,
                'notes' => $notes
            ]);
        } else {
            $reservation = Reservation::orderBy('created_at','desc')->first();
            return view('dashboard', [
                'reservation' => $reservation
            ]);
        }
    }
}
