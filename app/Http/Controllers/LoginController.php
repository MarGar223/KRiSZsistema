<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {

       $this->validate($request, [
           'email' => 'required',
           'password' => 'required',
       ]);

       if(!auth()->attempt($request->only('email', 'password'))){
           echo $request->email;
           echo $request->password;
           return back()->with('status', 'Neteisingi prisijungimo duomenys');
       }

       return redirect()->route('dashboard');
    }
}
