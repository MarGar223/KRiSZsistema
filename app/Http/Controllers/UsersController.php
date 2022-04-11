<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function index() {
        $users = User::orderBy('name', 'asc')->get();

        return view('Auth.users', [
            'users' => $users
        ]);
    }
    public function editUser(User $user){
        $userLevels = UserLevel::get();
        return view('Auth.editUser', [
            'user' => $user,
            'userLevels' => $userLevels
        ]);
    }
}
