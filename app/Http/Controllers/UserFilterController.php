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
                $users = $users->where('name', $request->input('userNames'))->paginate(15);
                break;
            case ($request->input('userRole')):
                $users = $users->where('role', $request->input('userRole'))->paginate(15);
                break;
            case ($request->input('userEmail')):
                $users = $users->where('email', $request->input('userEmail'))->paginate(15);
                break;
            case ($request->input('userLevel')):
                $users = $users->where('level', $request->input('userLevel'))->paginate(15);
                break;
            }



            return view('Auth.filter', [
                'users' => $users,
                'uri' => $uri,
                'userLevels' => $userLevels
            ]);
    }
}
