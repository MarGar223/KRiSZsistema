<?php

namespace App\Http\Controllers;

use App\Models\Reservation;


class ReservationController extends Controller
{
    public function index()
    {

        $reservations = Reservation::orderBy('created_at','desc')->get();

        return view('reservations.reservation', [
            'reservations' => $reservations
        ]);
    }


}
