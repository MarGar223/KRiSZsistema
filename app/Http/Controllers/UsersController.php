<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        $users = User::orderBy('name', 'asc')->get();

        return view('Auth.users', [
            'users' => $users
        ]);
    }
}
