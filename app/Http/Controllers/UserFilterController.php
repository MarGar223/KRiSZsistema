<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;

class UserFilterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }



    public function index(Request $request){
        $users = User::orderBy('name', 'asc');
        $userLevels = UserLevel::get();
        $uri = $request->path();

        switch ($request->input() != null) {
            case ($request->input('userNames')):
                $fullName = explode(';',$request->input('userNames'));
                $users = $users->where('name', $fullName[0])->where('surname', $fullName[1])->get();
                break;
            case ($request->input('userRole')):
                $users = $users->where('role', $request->input('userRole'))->get();
                break;
            case ($request->input('userEmail')):
                $users = $users->where('email', $request->input('userEmail'))->get();
                break;
            case ($request->input('userLevel')):
                $users = $users->where('user_level_id', $request->input('userLevel'))->get();
                break;
            }



            return view('Auth.filter', [
                'users' => $users,
                'uri' => $uri,
                'userLevels' => $userLevels
            ]);
    }
}
