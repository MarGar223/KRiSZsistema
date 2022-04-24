<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ReservationFilterController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::orderBy('updated_at', 'desc');
        $zones = Zone::get();
        $users = User::get();




        switch ($request->input() != null) {
            case ($request->input('userId')):

                $reservations = $reservations->where('user_id', $request->input('userId'))->get();
                break;
            case ($request->input('zoneId')):
                $reservations = $reservations->where('zone_id', $request->input('zoneId'))->get();
                break;
            case ($request->input('resWhen')):
                $reservations = $reservations->where('updated_at', $request->input('resWhen'))->get();
                break;
            case ($request->input('dateWhen')):
                $reservations = $reservations->where('date_when', $request->input('dateWhen'))->get();
                break;
            case ($request->input('startWhen')):
                $reservations = $reservations->where('start_time', $request->input('startWhen'))->get();
                break;
            case ($request->input('endWhen')):
                $reservations = $reservations->where('end_time', $request->input('endWhen'))->get();
                break;
            case ($request->input('resPeople')):
                $reservations = $reservations->where('people_count', $request->input('resPeople'))->get();
                break;
            }



        return view('reservations.filter', [
            'reservations' => $reservations,
            'zones' => $zones,
            'users' => $users
        ]);
    }
}
