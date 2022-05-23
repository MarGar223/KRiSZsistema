<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function __construct()
    {
            $this->middleware('CheckIfAdmin');

    }

    public function index(Request $request) {
        $users = User::orderBy('name', 'asc')->get();
        $userLevels = UserLevel::get();
        $uri = $request->path();

        return view('Auth.users', [
            'users' => $users,
            'uri' => $uri,
            'userLevels' => $userLevels
        ]);
    }

    public function editUser(Request $request, User $user){





        if(($request->nameMod != $user->name) ||
            ($request->surnameMod != $user->surname) ||
            ($request->roleMod != $user->role) ||
            ($request->emailMod != $user->email) ||
            ($request->levelMod != $user->user_level_id)
            )
            {

                if($request->passwordMod == null){

                    $this->validate($request,[
                        'nameMod' => 'required|string|max:255',
                        'surnameMod' => 'required|string|max:255',
                        'roleMod' => 'required|string|max:255',
                        'emailMod' => ['required','email'],
                        'levelMod' => 'required'
                    ]);

                    $user->update([
                        'name' => $request->nameMod,
                        'surname' => $request->surnameMod,
                        'role' => $request->roleMod,
                        'email' => $request->emailMod,
                        'user_level_id' => $request->levelMod
                        ]);

                } else {

                    $this->validate($request,[
                        'nameMod' => 'required|string|max:255',
                        'surnameMod' => 'required|string|max:255',
                        'roleMod' => 'required|string|max:255',
                        'emailMod' => ['required','email'],
                        'passwordMod' => [ Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                        'required',
                        'confirmed'],
                        'levelMod' => 'required'
                    ]);

                    $user->update([
                        'name' => $request->nameMod,
                        'surname' => $request->surnameMod,
                        'role' => $request->roleMod,
                        'email' => $request->emailMod,
                        'password' => Hash::make($request->passwordMod),
                        'user_level_id' => $request->levelMod
                        ]);


                }
                if($request->passwordMod != null){
                    dd('aaa');
                    $this->validate($request,[
                        'nameMod' => 'required|string|max:255',
                        'surnameMod' => 'required|string|max:255',
                        'roleMod' => 'required|string|max:255',
                        'emailMod' => ['required','email'],
                        'passwordMod' => [ Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),
                        'required',
                        'confirmed'],
                        'levelMod' => 'required'
                    ]);

                    $user->update([
                        'name' => $request->nameMod,
                        'surname' => $request->surnameMod,
                        'role' => $request->roleMod,
                        'email' => $request->emailMod,
                        'password' => Hash::make($request->passwordMod),
                        'user_level_id' => $request->levelMod
                        ]);
                }
                return back()->with('success', 'Vartotojas redaguotas sėkmingai');
            } else if($request->passwordMod != null){

                $this->validate($request,[
                    'nameMod' => 'required|string|max:255',
                    'surnameMod' => 'required|string|max:255',
                    'roleMod' => 'required|string|max:255',
                    'emailMod' => ['required','email'],
                    'passwordMod' => [ Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                    'required',
                    'confirmed'],
                    'levelMod' => 'required'
                ]);

                $user->update([
                    'name' => $request->nameMod,
                    'surname' => $request->surnameMod,
                    'role' => $request->roleMod,
                    'email' => $request->emailMod,
                    'password' => Hash::make($request->passwordMod),
                    'user_level_id' => $request->levelMod
                    ]);
                    return back()->with('success', 'Vartotojas redaguotas sėkmingai');
            }
            return back();


    }

    public function deleteUser(User $user){

        if($user->user_level_id != 1){
            $user->delete();
        }

        return back();
    }
}
