<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Zone;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $zones = Zone::get();
        $reservations = Reservation::get();

        return view('reservation', [
            'zones' => $zones,
            'reservations' => $reservations
        ]);

    }

    public function createReservation(Request $request)
    {

            $this->validate($request,[
                'zone' => 'required',
                'people_count' => 'required',
                'date_when' => 'required',
                'start_time' => 'required',
                'end_time'  => 'required'
            ]);

            $request->user()->reservations()->create([
                    'zone_id' => $request->zone,
                    'people_count' => $request->people_count,
                    'date_when' => $request->date_when,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time
            ]);

            return back();

    }
}
