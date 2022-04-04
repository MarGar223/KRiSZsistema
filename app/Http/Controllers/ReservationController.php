<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {

        return view('reservation');


    }

    public function createReservation(Request $request)
    {
        $this->validate($request, [
            'zone_id' => 'required',
            'people_count' => 'required',
            'date_when' => 'required',
            'starts_with' => 'required',
            'end_time' => 'required'
        ]);
    }
}
