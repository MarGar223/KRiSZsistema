<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index()
    {

        $reservations = Reservation::orderBy('created_at','desc')->paginate(5);

        return view('reservations.reservation', [
            'reservations' => $reservations
        ]);
    }


}
