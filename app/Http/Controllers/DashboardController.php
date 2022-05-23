<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $zones = Zone::get();
        $user = auth()->user();

        $time = Carbon::now()->toTimeString();
        $date = Carbon::now()->toDateString();





        $pastReservation = Reservation::where('date_when', '<=', $date)->where('end_time', '<=', $time)->get();


        foreach ($pastReservation as $past) {
            DB::table('reservations')->where('id', $past->id)->update(['old_reservation' => 1]);
        }

        $reservations = Reservation::orderBy('updated_at', 'desc')->where('old_reservation', 0)->get();

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
