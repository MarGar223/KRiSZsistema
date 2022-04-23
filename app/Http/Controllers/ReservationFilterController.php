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
    public function index(User $user, Zone $zone){



        $reservations = Reservation::orderBy('updated_at', 'desc')->get();
        $zones = Zone::get();
        $users = User::get();
        // var_dump($reservations);
        // if($user != null){
        //     $reservations = Reservation::where('user_id', $user->id)->get();
        // }
        // if($zone != null){

        // }

        return view('reservations.reservation', [
                    'reservations' => $reservations,
                    'zones' => $zones,
                    'users' => $users
                ]);


    }
}
