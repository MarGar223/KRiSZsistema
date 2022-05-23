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
            return back()->with('status', 'Pradžios laikas negali būti vėlesnis arba toks pat kaip pabaigos laiką')->withInput();
        }
        if ($request->input()) {
            $otherReservation = Reservation::where('zone_id', $request->input('zone'))
                ->where('date_when', $request->input('date_when'))->get();
            $zone = Zone::where('id', $request->input('zone'))->first();



            foreach ($otherReservation as $item) {


                if (($request->start_time >= $item->start_time) && ($request->start_time < $item->end_time)) {
                    return back()->with('status', 'Tokiu laiku ši zona jau rezervuota')->withInput();
                }

                if (($request->end_time > $item->start_time) && ($request->end_time < $item->end_time)) {
                    return back()->with('status', 'Tokiu laiku ši zona jau rezervuota')->withInput();
                }
                if (($request->start_time < $item->start_time) && ($request->end_time > $item->end_time)) {
                    return back()->with('status', 'Tokiu laiku ši zona jau rezervuota')->withInput();
                }

                if (($request->people_count <= 0) || ($request->people_count > $zone->max_people_count)) {
                    return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.')->withInput();
                }
            }

            $request->user()->reservations()->create([
                'zone_id' => $request->zone,
                'people_count' => $request->people_count,
                'date_when' => $request->date_when,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return back()->with('success', 'Rezervacija atlikta sėkmingai');
        }
    }




    public function editReservation(Request $request, Reservation $reservation)
    {
        $otherReservation = Reservation::where('zone_id', $request->input('zoneMod'))
            ->where('date_when', $request->input('date_whenMod'))->get();

        $zone = Zone::where('id', $request->input('zoneMod'))->first();



        if (($request->user()->id == $reservation->user_id) || ($request->user()->user_level_id == 1) || ($request->user()->user_level_id == 2)) {

            if ($request->input()) {

                $this->validate($request, [
                    'zoneMod' => 'required',
                    'people_countMod' => 'required',
                    'date_whenMod' => 'required',
                    'start_timeMod' => 'required',
                    'end_timeMod'  => 'required'
                ]);

                if (
                    (($request->input('zoneMod') != $reservation->zone_id) ||
                        ($request->input('date_whenMod') != $reservation->date_when) ||
                        ($request->input('start_timeMod') != $reservation->start_time) ||
                        ($request->input('end_timeMod') != $reservation->end_time) ||
                        ($request->input('people_countMod') != $reservation->people_count)) &&
                    ($request->input('start_timeMod') <= $request->input('end_timeMod'))
                ) {

                    foreach ($otherReservation as $item) {
                        if ($reservation->id == $item->id) {

                            if (($request->people_countMod <= 0) || ($request->people_countMod > $zone->max_people_count)) {
                                return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
                            }
                            if ((($request->start_timeMod >= $item->start_time) && ($request->start_timeMod < $item->end_time)) &&
                                (($request->end_timeMod > $item->start_time) && ($request->end_timeMod <= $item->end_time))
                            ) {
                                continue;
                            }
                        }

                        if ($reservation->id != $item->id) {

                            if (($request->start_timeMod >= $item->start_time) && ($request->start_timeMod < $item->end_time)) {

                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                            }

                            if (($request->end_timeMod > $item->start_time) && ($request->end_timeMod < $item->end_time)) {
                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                            }
                            if (($request->start_timeMod < $item->start_time) && ($request->end_timeMod > $item->end_time)) {
                                return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                            }
                        }
                        if (($request->people_countMod <= 0) || ($request->people_countMod > $zone->max_people_count)) {
                            return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
                        }
                    }
                    $reservation->update([
                        'zone_id' => $request->zoneMod,
                        'people_count' => $request->people_countMod,
                        'date_when' => $request->date_whenMod,
                        'start_time' => $request->start_timeMod,
                        'end_time' => $request->end_timeMod
                    ]);
                    return back()->with('success', 'Rezervacija redaguota sėkmingai');
                } else {
                    return back();
                }
            }
        }
    }

    public function editReservationFromDashboard(Request $request, Reservation $reservation)
    {
        $otherReservation = Reservation::where('zone_id', $request->input('zone'))
            ->where('date_when', $request->input('date_when'))->get();

        $zone = Zone::where('id', $request->input('zone'))->first();

        if ($request->input()) {
            $this->validate($request, [
                'zone' => 'required',
                'people_count' => 'required',
                'date_when' => 'required',
                'start_time' => 'required',
                'end_time'  => 'required'
            ]);
            if (
                (($request->input('zone') != $reservation->zone_id) ||
                    ($request->input('date_when') != $reservation->date_when) ||
                    ($request->input('start_time') != $reservation->start_time) ||
                    ($request->input('end_time') != $reservation->end_time) ||
                    ($request->input('people_count') != $reservation->people_count)) &&
                    ($request->input('start_time') <= $request->input('end_time'))
            ) {
                foreach ($otherReservation as $item) {
                    if ($reservation->id == $item->id) {
                        if (($request->people_count <= 0) || ($request->people_count > $zone->max_people_count)) {
                            return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
                        }
                        if ((($request->start_time >= $item->start_time) && ($request->start_time < $item->end_time)) &&
                            (($request->end_time > $item->start_time) && ($request->end_time <= $item->end_time))
                        ) {
                            continue;
                        }
                    }

                    if ($reservation->id != $item->id) {
                        if (($request->start_time > $item->start_time) && ($request->start_time < $item->end_time)) {
                            return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                        }

                        if (($request->end_time > $item->start_time) && ($request->end_time < $item->end_time)) {
                            return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                        }
                        if (($request->start_time < $item->start_time) && ($request->end_time > $item->end_time)) {
                            return back()->with('status', 'Tokiu laiku ši zona jau rezervuota');
                        }
                    }
                    if (($request->people_count <= 0) && ($request->people_count > $zone->max_people_count)) {
                        return back()->with('status', 'Tokiam žmonių kiekiui zona netinkama. Galimas maximalus kiekis ' . $zone->max_people_count . ' asmenų.');
                    }
                }
                $request->user()->reservations()->where('id', $reservation->id)->update([
                    'zone_id' => $request->zone,
                    'people_count' => $request->people_count,
                    'date_when' => $request->date_when,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time
                ]);

                return back()->with('success', 'Rezervacija redaguota sėkmingai');
            } else {
                return back();
            }
        }
    }


    public function deleteReservation(Request $request, Reservation $reservation)
    {

        if ($request->user()->id == $reservation->user_id) {
            $reservation->delete();
        } else if ($request->user()->user_level_id == 1 || $request->user()->user_level_id == 2) {
            $reservation->delete();
        }



        return back()->with('success', 'Rezervacija ištrinta');
    }

    public function deleteReservationFromDashboard(Reservation $reservation)
    {
        $reservation->delete();

        return back()->with('success', 'Rezervacija ištrinta');
    }
}
