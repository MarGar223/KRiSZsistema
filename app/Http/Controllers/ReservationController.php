<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {

        $date = date('Y-m-d');

        $zones = Zone::get();
        $users = User::get();



        $pastReservation = Reservation::where('date_when', '<', $date)->get();


        foreach ($pastReservation as $past) {
            DB::table('reservations')->where('id', $past->id)->update(['old_reservation' => 1]);
        }

        $reservations = Reservation::orderBy('updated_at', 'desc')->where('old_reservation', 0)->get();


            return view('reservations.reservation', [
            'reservations' => $reservations,
            'zones' => $zones,
            'users' => $users
        ]);

    }

}
