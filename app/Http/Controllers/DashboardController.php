<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Zone;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $zones = Zone::get();
        $user = auth()->user();
        if($user){
            $reservations = Reservation::orderBy('updated_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'rezervacijos');
            $notes = Note::orderBy('updated_at','desc')->where('user_id',$user->id)->paginate(3, ['*'], 'uzrasai');
            $uri = $request->path();


            return view('dashboard', [
                'user' => $user,
                'reservations' => $reservations,
                'notes' => $notes,
                'uri' => $uri,
                'zones' => $zones
            ]);
        } else {
            $reservation = Reservation::orderBy('updated_at','desc')->first();
            return view('dashboard', [
                'reservation' => $reservation
            ]);
        }
    }
}
