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
       $this->middleware('auth');
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

        if($request->input('password') == null){

            $this->validate($request,[
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'email' => ['required','email'],
                'level' => 'required'
            ]);

            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'user_level_id' => $request->level
                ]);
        } else {

            $this->validate($request,[
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'email' => ['required','email','unique:users,email'],
                'password' => [ Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
                'required',
                'confirmed'],
                'level' => 'required'
            ]);

            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_level_id' => $request->level
                ]);
        }
        return redirect()->route('allUsers');
    }

    public function deleteUser(Request $request, User $user){

        if($user->user_level_id != 1){
            $user->delete();
        }

        return redirect()->route('allUsers');
    }
}
