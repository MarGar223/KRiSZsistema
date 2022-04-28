<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReservationFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $zones = Zone::get();
        return view('reservations.form', [
            'zones' => $zones
        ]);
    }

    public function createReservation(Request $request)
    {

        $this->validate($request, [
            'zone' => 'required',
            'people_count' => 'required',
            'date_when' => 'required',
            'start_time' => 'required',
            'end_time'  => 'required'
        ]);

        if ($request->input('start_time') >= $request->input('end_time')) {
            return back()->with('status', 'Pradžios laikas negali būti vėlesnis arba toks pat kaip pabaigos laiką');
        }
        if ($request->input()) {

            $reservation = Reservation::where('zone_id', $request->input('zone'))
                ->where('date_when', $request->input('date_when'))->first();
            $zone = Zone::where('id', $request->input('zone'))->first();


            if ($reservation) {
                if ($request->input('start_time') == $reservation->start_time) {
                    return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                }

                if ($request->input('start_time') < $reservation->end_time) {
                    return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                }
            }
            if (($request->input('people_count') <= 0) && ($request->input('people_count') <= $zone->max_people_count)) {
                return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
            }
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
        $otherReservation = Reservation::where('zone_id', $request->input('zone'))
            ->where('date_when', $request->input('date_when'))->get();

        $reservationFirst = Reservation::where('zone_id', $request->input('zone'))
            ->where('date_when', $request->input('date_when'))->first();

        $zone = Zone::where('id', $request->input('zone'))->first();



        if (($request->user()->id == $reservation->user_id) || ($request->user()->user_level_id == 1) || ($request->user()->user_level_id == 2)) {

            if ($request->input()) {
                if (
                    (($request->input('zone') != $reservation->zone_id) ||
                    ($request->input('date_when') != $reservation->date_when) ||
                    ($request->input('start_time') != $reservation->start_time) ||
                    ($request->input('end_time') != $reservation->end_time) ||
                    ($request->input('people_count') != $reservation->people_count)) &&
                    ($request->input('start_time') <= $request->input('end_time')))

                 {

                    foreach ($otherReservation as $item) {
                        if ($reservation->id == $item->id) {

                            if ((($request->start_time >= $item->start_time) && ($request->start_time < $item->end_time)) &&
                                (($request->end_time > $item->start_time) && ($request->end_time <= $item->end_time))
                            ) {
                                continue;
                            }
                        }

                        if ($reservation->id != $item->id) {
                            if (($request->start_time > $item->start_time) && ($request->start_time < $item->end_time)) {

                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota start time');
                            }

                            if (($request->end_time > $item->start_time) && ($request->end_time < $item->end_time)) {
                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota end time');
                            }
                            if (($request->start_time < $item->start_time) && ($request->end_time > $item->end_time)) {
                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota over time');
                            }
                        }
                        if (($request->input('people_count') <= 0) && ($request->input('people_count') <= $zone->max_people_count)) {
                            return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
                        }
                        $reservation->update([
                            'zone_id' => $request->zone,
                            'people_count' => $request->people_count,
                            'date_when' => $request->date_when,
                            'start_time' => $request->start_time,
                            'end_time' => $request->end_time
                        ]);
                    }
                }
            }
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
