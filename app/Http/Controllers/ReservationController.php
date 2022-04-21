<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ReservationController extends Controller
{
    public function index(Request $request)
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

    public function test(){
        $reservations = Reservation::orderBy('updated_at', 'desc')->get();
        $zones = Zone::get();
        return view('testMap')->with((compact(['reservations','zones'])));
    }

    public function testStore(Request $request)
    {
        $data = $request->user()->reservations()->create([
            'zone_id' => $request->zone,
            'people_count' => $request->people_count,
            'date_when' => $request->date_when,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
        $todo = Reservation::create($data);
        return Response::json($todo);
    }
}
