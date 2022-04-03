<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
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

       if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){

           return back()->with('status', 'Neteisingi prisijungimo duomenys');
       }

       return redirect()->route('dashboard');
    }


}
