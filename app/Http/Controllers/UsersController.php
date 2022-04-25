<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

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
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'role' => 'required|max:255',
                'email' => 'required|email|max:255',
                'level' => 'required'
            ]);
            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'level' => $request->level
                ]);
        } else {
            $this->validate($request,[
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'role' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',
                'level' => 'required'
            ]);

            $user->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => $request->level
                ]);
        }
        return redirect()->route('allUsers');
    }

    public function deleteUser(Request $request, User $user){

        if($user->level != 'Administratorius'){
            $request->user()->where('id', $user->id)->delete();
        }

        return redirect()->route('allUsers');
    }
}
