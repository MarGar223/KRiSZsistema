<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if($user){
            $reservations = Reservation::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(2);


            return view('dashboard', [
                'user' => $user,
                'reservations' => $reservations
            ]);
        } else {
            return view('dashboard');
        }

    }
}
