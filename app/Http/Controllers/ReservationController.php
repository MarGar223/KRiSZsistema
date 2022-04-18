<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Zone;


class ReservationController extends Controller
{
    public function index()
    {

        $reservations = Reservation::orderBy('created_at','desc')->get();
        $zones = Zone::get();

        return view('reservations.reservation', [
            'reservations' => $reservations,
            'zones' => $zones
        ]);
    }


}
