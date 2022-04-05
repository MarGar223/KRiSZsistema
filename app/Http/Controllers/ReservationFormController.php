<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ReservationFormController extends Controller
{
    public function index(){
        $zones = Zone::get();

        return view('reservations.form',[
            'zones' => $zones
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

            return redirect()->route('reservation');
    }
}
