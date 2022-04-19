<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Laravel\Ui\Presets\React;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $reservation = Reservation::get();
        $uri = $request->path();
        $list = array();
        $pirmas = 0;
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, date('m'), $d, date('Y'));
            if (date('m', $time) == date('m'))
                $list[] = date('Y-m-d-D', $time);
        }

        return view('testMap', [
            'list' => $list,
            'pirmas' => $pirmas,
            'uri' => $uri,
            'reservation' => $reservation
        ]);
    }

    public function showReservations(Request $request)
    {

        $uri = $request->getPathInfo();
        $date = date('Y-m-d');
        $reservation = Reservation::where('date_when', $date)->get();


        return view('testMap', [
            'reservation' => $reservation,
            'uri' => $uri
        ]);
    }
}
