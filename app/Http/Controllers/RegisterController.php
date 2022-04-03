<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function addUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'role' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'level' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level
        ]);

        return view('dashboard');

    }
}
