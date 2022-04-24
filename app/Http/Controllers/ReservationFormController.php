<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Zone;
use Illuminate\Http\Request;

class ReservationFormController extends Controller
{
    public function index()
    {
        $zones = Zone::get();
        return view('reservations.form', [
            'zones' => $zones
        ]);
    }

    public function createReservation(Request $request)
    {
        // dd($request->input('start_time'));

        $this->validate($request, [
            'zone' => 'required',
            'people_count' => 'required',
            'date_when' => 'required',
            'start_time' => 'required',
            'end_time'  => 'required'
        ]);

        if($request->input('start_time') > $request->input('end_time')){
            return back()->with('status', 'Pradžios laikas negali būti vėlesnis už pabaigos laiką');
        }

        $request->user()->reservations()->create([
            'zone_id' => $request->zone,
            'people_count' => $request->people_count,
            'date_when' => $request->date_when,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return redirect()->route('reservation');
    }

    public function showReservation(Reservation $reservation)
    {

        $zones = Zone::get();

        return view('reservations.edit', [
            'reservation' => $reservation,
            'zones' => $zones
        ]);
    }

    public function editReservation(Request $request, Reservation $reservation)
    {


        if($request->user()->id == $reservation->user_id){

            $request->user()->reservations()->where('id', $reservation->id)->update([
            'zone_id' => $request->zone,
            'people_count' => $request->people_count,
            'date_when' => $request->date_when,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
            ]);
        } else if($request->user()->level === 'Administratorius' || $request->user()->level === 'Instruktorius'){
            $reservation->where('id', $reservation->id)->update([
            'zone_id' => $request->zone,
            'people_count' => $request->people_count,
            'date_when' => $request->date_when,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
            ]);
        }


            return redirect()->route('reservation');


    }

    public function editReservationFromDashboard(Request $request, Reservation $reservation)
    {
            $request->user()->reservations()->where('id', $reservation->id)->update([
            'zone_id' => $request->zone,
            'people_count' => $request->people_count,
            'date_when' => $request->date_when,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
            ]);

        return redirect()->route('dashboard');
    }

    public function deleteReservation(Request $request, Reservation $reservation)
    {

        if ($request->user()->id == $reservation->user_id) {
            $reservation->delete();
        } else if ($request->user()->level == 'Administratorius' || $request->user()->level == 'Instruktorius') {
            $reservation->delete();
        }



        return redirect()->route('reservation');
    }

    public function deleteReservationFromDashboard(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('dashboard');
    }
}
