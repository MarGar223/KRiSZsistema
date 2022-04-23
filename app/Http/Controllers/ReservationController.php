<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('updated_at', 'desc')->get();
        $zones = Zone::get();
        $users = User::get();

        return view('reservations.reservation', [
            'reservations' => $reservations,
            'zones' => $zones,
            'users' => $users
        ]);

    }

}
