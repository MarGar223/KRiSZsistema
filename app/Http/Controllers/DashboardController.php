<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if($user){
            $reservations = Reservation::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'rezervacijos');
            $notes = Note::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'uzrasai');
            $uri = $request->path();


            return view('dashboard', [
                'user' => $user,
                'reservations' => $reservations,
                'notes' => $notes,
                'uri' => $uri
            ]);
        } else {
            $reservation = Reservation::orderBy('created_at','desc')->first();
            return view('dashboard', [
                'reservation' => $reservation
            ]);
        }
    }
}
