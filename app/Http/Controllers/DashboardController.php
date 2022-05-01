<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $zones = Zone::get();
        $user = auth()->user();

        $pastReservation = Reservation::where('date_when', '<', $date)->get();
        foreach ($pastReservation as $past) {
            DB::table('reservations')->where('id', $past->id)->update(['old_reservation' => 1]);
        }
        if($user){



            $reservations = Reservation::orderBy('updated_at','desc')->where('user_id',$user->id)->where('old_reservation', 0)->paginate(3);
            $notes = Note::orderBy('updated_at','desc')->where('user_id',$user->id)->paginate(3);
            $uri = $request->path();


            return view('dashboard', [
                'user' => $user,
                'reservations' => $reservations,
                'notes' => $notes,
                'uri' => $uri,
                'zones' => $zones
            ]);
        } else {

            $reservation = Reservation::orderBy('updated_at','desc')->where('old_reservation', 0)->first();
            return view('dashboard', [
                'reservation' => $reservation
            ]);
        }
    }
}
