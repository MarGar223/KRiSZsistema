<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {
        $time = Carbon::now()->toTimeString();
        $date = Carbon::now()->toDateString();

        $zones = Zone::get();
        $users = User::get();



        $pastReservation = Reservation::where('date_when', '<=', $date)->where('end_time', '<=', $time)->get();


        foreach ($pastReservation as $past) {
            DB::table('reservations')->where('id', $past->id)->update(['old_reservation' => 1]);
        }

        $reservations = Reservation::orderBy('updated_at', 'desc')->where('old_reservation', 0)->get();


            return view('reservations.reservation', [
            'reservations' => $reservations,
            'zones' => $zones,
            'users' => $users,
        ]);

    }


    // public function index(){
    //     $zones = Zone::get();
    //     $users = User::get();


    //     $reservations = Reservation::orderBy('updated_at', 'desc')->get();


    //     $data = response()->json($reservations);

    //     // dd(compact('reservations'));


    //     return view('resTest', [
    //         'data' => compact('reservations'),
    //         'zones' => $zones,
    //     ]);
    // }

    // public function addAjax(Request $request){


    //     $reservation = new Reservation();
    //     $reservation->user_id = $request->userId;
    //     $reservation->zone_id = $request->zone;
    //     $reservation->date_when = $request->dateWhen;
    //     $reservation->start_time = $request->startTime;
    //     $reservation->end_time = $request->endTime;
    //     $reservation->people_count = $request->peopleCount;

    //     $reservation->save();

    //     $newRes = Reservation::latest()->first();

    //     // dd($newRes);


    //    return response()->json(['success' => "Added successfully", 'res' => compact('newRes') ]);

    // }

}
